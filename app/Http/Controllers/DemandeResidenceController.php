<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Demande;
use Illuminate\Http\Request;
use App\Models\Classement;
use App\Models\AnneeAcademique;
use Illuminate\Support\Facades\DB;
use App\Models\Cabine;
use App\Models\Planification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemandeRecue;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Etablissement;

class DemandeResidenceController extends Controller
{

    public function index()
    {
        return view('vitrine.index');
         $etablissements = Etablissement::all(); // Récupère tous les établissements
        return view('vitrine.createdemande', compact('etablissements'));
    }



    public function create()
    {
        $anneeAcademique = \App\Models\AnneeAcademique::latest()->first();

        if (!$anneeAcademique) {

        }

        $planification = \App\Models\Planification::where('statut', 'ouverte')
            ->where('description', 'Lancement d\'inscription')
            ->where('annee_academique_id', $anneeAcademique->id)
            ->latest()
            ->first();

        if (!$planification) {

        }

        $etablissements = Etablissement::all();

        return view('vitrine.createdemande', compact('planification', 'etablissements'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'matricule' => 'required|string|max:50',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'adresse_personnelle' => 'required|string|max:255',
            'etablissement_id' => 'required|exists:etablissements,id',
            'filiere' => 'required|string|max:255',
            'annee_etude' => 'required|string|max:255',
            'fiche_inscription' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10000',
            'sexe' => 'required|string|max:10',
            'nationalite' => 'required|string|max:255',
            'handicap' => 'required|boolean',
            'type_handicap' => 'nullable|string|max:255',
            'certificat_handicap' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10000',
        ]);

        // Vérifier s'il existe une planification ouverte
        $planification = \App\Models\Planification::where('statut', 'ouverte')
            ->where('description','Lancement d\'inscription')
            ->latest()
            ->first();

        if (!$planification) {
            return redirect()->back()->with('error', 'Aucune planification en cours. Veuillez réessayer plus tard.');
        }

        // Vérifier si l'étudiant existe déjà
        $etudiant = \App\Models\Etudiant::where('matricule', $validatedData['matricule'])->first();

        if (!$etudiant) {
            // Créer un nouvel étudiant
            $etudiant = new \App\Models\Etudiant();
            $etudiant->matricule = $validatedData['matricule'];
            $etudiant->nom = $validatedData['nom'];
            $etudiant->prenom = $validatedData['prenom'];
            $etudiant->email = $validatedData['email'];
            $etudiant->telephone = $validatedData['telephone'];
            $etudiant->date_naissance = $validatedData['date_naissance'];
            $etudiant->lieu_naissance = $validatedData['lieu_naissance'];
            $etudiant->adresse_personnelle = $validatedData['adresse_personnelle'];
            $etudiant->sexe = $validatedData['sexe'];
            $etudiant->nationalite = $validatedData['nationalite'];
            $etudiant->handicap = $validatedData['handicap'];
            $etudiant->type_handicap = $validatedData['type_handicap'] ?? null;

            if ($request->hasFile('certificat_handicap')) {
                $etudiant->certificat_handicap = $request->file('certificat_handicap')->store('handicap');
            }

            $etudiant->save();
        }

        // Vérifier une demande existante cette année pour cet étudiant
        $demandeExistante = \App\Models\Demande::where('etudiant_matricule', $etudiant->matricule)
        ->where('planification_id', $planification->id)
        ->first();

        if ($demandeExistante) {
            return redirect()->back()->with('error', 'Vous avez déjà soumis une demande cette année.');
        }

        // Créer la demande
        $demande = new \App\Models\Demande();
        $demande->etudiant_matricule = $etudiant->matricule;  // clé étrangère ici
        $demande->planification_id = $planification->id;
        $demande->etablissement_id = $validatedData['etablissement_id'];
        $demande->filiere = $validatedData['filiere'];
        $demande->annee_etude = $validatedData['annee_etude'];
        $demande->fiche_preinscription = $request->file('fiche_inscription')->store('fiches');
        $demande->code_suivi = strtoupper(uniqid('REQ'));
        $demande->statut = 'En cours de traitement';
        $demande->save();


        // Envoi de mail
        Mail::to($etudiant->email)->send(new \App\Mail\DemandeRecue($demande, $demande->code_suivi));

        return redirect()->route('demandes.confirmation', ['code_suivi' => $demande->code_suivi]);
    }


       public function createSimple()
    {
        $anneeAcademique = \App\Models\AnneeAcademique::latest()->first();

        if (!$anneeAcademique) {

        }

        $planification = \App\Models\Planification::where('statut', 'ouverte')
            ->where('description', 'Lancement d\'inscription')
            ->where('annee_academique_id', $anneeAcademique->id)
            ->latest()
            ->first();

        if (!$planification) {

        }

        $etablissements = Etablissement::all();

        return view('vitrine.demande_simple', compact('planification', 'etablissements'));
    }


    public function storeSimple(Request $request)
    {
        // ✅ Étape 1 : Validation des données
        $validatedData = $request->validate([
            'matricule' => 'required|string|max:50',
            'etablissement_id' => 'required|exists:etablissements,id',
            'filiere' => 'required|string|max:255',
            'annee_etude' => 'required|string|max:255',
            'fiche_inscription' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10000',
        ]);

        // ✅ Étape 2 : Vérifier l'existence de l'étudiant
        $etudiant = \App\Models\Etudiant::where('matricule', $validatedData['matricule'])->first();

        if (!$etudiant) {
            return back()->withInput()->with('error', 'Aucun étudiant trouvé avec ce matricule.');
        }

        // ✅ Étape 3 : Vérifier qu'une planification est ouverte
        $planification = \App\Models\Planification::where('statut', 'ouverte')
            ->where('description', 'Lancement d\'inscription')
            ->latest()
            ->first();

        if (!$planification) {
            return back()->with('error', 'Aucune planification ouverte pour le moment.');
        }

        // ✅ Étape 4 : Vérifier l’unicité de la demande pour cette année
        $demandeExistante = \App\Models\Demande::where('etudiant_matricule', $etudiant->matricule)
            ->where('planification_id', $planification->id)
            ->first();

        if ($demandeExistante) {
            return back()->with('error', 'Vous avez déjà soumis une demande cette année.');
        }

        // ✅ Étape 5 : Enregistrement du fichier
        $fichePath = $request->file('fiche_inscription')->store('fiches', 'public'); // Stockage dans "storage/app/public/fiches"

        // ✅ Étape 6 : Création de la demande
        $demande = new \App\Models\Demande();
        $demande->etudiant_matricule = $etudiant->matricule;
        $demande->planification_id = $planification->id;
        $demande->etablissement_id = $validatedData['etablissement_id'];
        $demande->filiere = $validatedData['filiere'];
        $demande->annee_etude = $validatedData['annee_etude'];
         $demande->fiche_preinscription = $request->file('fiche_inscription')->store('fiches');
        $demande->code_suivi = strtoupper(uniqid('REQ'));
        $demande->statut = 'En cours de traitement';
        $demande->save();

        // ✅ Étape 7 : Envoi de l'e-mail de confirmation
        try {
            \Mail::to($etudiant->email)->send(new \App\Mail\DemandeRecue($demande, $demande->code_suivi));
        } catch (\Exception $e) {
            // Log ou gestion d'échec d'envoi
            \Log::error("Erreur lors de l'envoi de l'email : " . $e->getMessage());
        }

        // ✅ Étape 8 : Redirection avec confirmation
        return redirect()->route('demandes.confirmation', ['code_suivi' => $demande->code_suivi])
            ->with('success', 'Demande soumise avec succès !');
    }



    public function exportPdf(Request $request)
    {
        $academicYearId = $request->academic_year_id;
        $filtre = $request->input('filtre', 'all');

        // Récupère le nom de l'année académique
        $academicYear = AnneeAcademique::find($academicYearId);

        // Requête filtrée
        $demandes = Demande::with('classement')
            ->whereHas('planification', function ($query) use ($academicYearId) {
                $query->where('annee_academique_id', $academicYearId);
            })
            ->when($filtre === 'classe', function ($query) {
                $query->whereHas('classement');
            })
            ->when($filtre === 'non_classe', function ($query) {
                $query->doesntHave('classement');
            })
            ->when($filtre === 'classe_non_valide', function ($query) {
            $query->whereHas('classement', function ($q) {
                $q->where(function ($cond) {
                    $cond->whereNull('est_valide')
                        ->orWhere('est_valide', '!=', 1);
                    })->where('peut_valider', '!=', false);
                });
            })
            ->when($filtre === 'classement_invalide', function ($query) {
                $query->whereHas('classement', function ($q) {
                    $q->where('peut_valider', false);
                });
            })
            ->get();

        // Génère le PDF depuis la vue PDF
        $pdf = Pdf::loadView('pages.demandes.pdf', [
            'demandes' => $demandes,
            'academicYear' => $academicYear,
        ]);

        return $pdf->download('demandes_' . now()->format('Ymd_His') . '.pdf');
    }

    public function confirmation($code_suivi)
    {
        return view('vitrine.messageconfirmation', ['code_suivi' => $code_suivi]);
    }


    public function suivre()
    {
        return view('vitrine.suivi');
    }

    public function suivreDemande(Request $request)
    {
        // Valider que le code de suivi a été soumis
        $request->validate([
            'tracking_code' => 'required|string|max:255',
        ]);

        // Rediriger vers la page d'affichage de la demande avec le code de suivi
        return redirect()->route('afficher.demande', ['code_suivi' => $request->tracking_code]);
    }


        public function afficherDemande($code_suivi)
    {
        // 🔹 Étape 1 : Vérifier si la demande existe
        $demande = Demande::where('code_suivi', $code_suivi)->first();

        if (!$demande) {
            return redirect()->back()->with('error', 'Aucune demande trouvée avec ce code de suivi.');
        }

        // 🔹 Étape 2 : Récupérer la dernière année académique
        $anneeAcademique = \App\Models\AnneeAcademique::latest()->first();

        if (!$anneeAcademique) {
            return redirect()->back()->with('error', 'Aucune année académique trouvée.');
        }

        // Vérifier si la demande appartient à la dernière année académique
        if ($demande->planification->annee_academique_id !== $anneeAcademique->id) {
            return redirect()->back()->with('error', 'Ce code de suivi appartient à une ancienne année académique.');
        }

        // 🔹 Étape 3 : Vérifier si une planification "résultat" avec statut "ouverte" existe pour cette année académique
        $planificationResultat = Planification::where('description', 'Résultat')
            ->where('statut', 'ouverte')
            ->where('annee_academique_id', $anneeAcademique->id)
            ->first();

        if (!$planificationResultat) {
            return view('vitrine.infodemande', [
                'message' => 'Demande en cours de traitement.',
                'demande' => $demande // 🔹 Passer les infos de la demande
            ]);
        }

        // 🔹 Étape 4 : Vérifier si la demande est classée
        $classement = Classement::where('code_suivi', $code_suivi)->first();

        if ($classement) {
            $cabine = Cabine::where('id', $classement->cabine_id)->first();

            return view('vitrine.infodemande', [
                'message' => 'Félicitations ! Vous avez été retenu.',
                'classement' => $classement,
                'cabine' => $cabine,
                'demande' => $demande // 🔹 Passer les infos de la demande
            ]);
        }

        // 🔹 Étape 5 : Si la demande n'est pas classée, afficher un message de non-admission
        return view('vitrine.infodemande', [
            'message' => 'Désolé, vous n’avez pas été retenu.',
            'demande' => $demande // 🔹 Passer les infos de la demande
        ]);
    }



    public function admin_index(Request $request)
    {
        // Récupérer la dernière année académique créée
        $latestAcademicYear = \App\Models\AnneeAcademique::latest()->first();

        if (!$latestAcademicYear) {
            return redirect()->back()->with('error', 'Aucune année académique trouvée.');
        }

        // Récupérer l'année sélectionnée et le filtre
        $academicYearId = $request->input('academic_year_id', $latestAcademicYear->id);
        $filtre = $request->input('filtre', 'all');

        // Requête avec filtres dynamiques
        $demandes = \App\Models\Demande::with('classement')
            ->whereHas('planification', function ($query) use ($academicYearId) {
                $query->where('annee_academique_id', $academicYearId);
            })
            ->when($filtre === 'classe', function ($query) {
                $query->whereHas('classement');
            })
            ->when($filtre === 'non_classe', function ($query) {
                $query->doesntHave('classement');
            })
        ->when($filtre === 'classe_non_valide', function ($query) {
                $query->whereHas('classement', function ($q) {
                    $q->where(function ($cond) {
                        $cond->whereNull('est_valide')
                            ->orWhere('est_valide', '!=', 1);
                    })->where('peut_valider', true); // On ne garde que ceux qu'on peut encore valider
                });
            })

            ->when($filtre === 'classement_invalide', function ($query) {
                $query->whereHas('classement', function ($q) {
                    $q->where('peut_valider', false);
                });
            })
            ->get();

        $academicYears = \App\Models\AnneeAcademique::orderBy('id', 'desc')->get();

        return view('pages.demandes.index', compact('demandes', 'academicYearId', 'academicYears', 'filtre'));
    }


    public function autocomplete(Request $request)
    {
        $term = $request->input('term');
        $codesSuivi = Demande::where('code_suivi', 'LIKE', '%' . $term . '%')
                            ->whereNotIn('code_suivi', Classement::pluck('code_suivi'))
                            ->get(['code_suivi']);

        return response()->json($codesSuivi);
    }


    function lancerClassement()
    {
    DB::transaction(function () {
        // 🔹 Récupérer la dernière planification avec description "Lancement d'inscription"
        $planification = Planification::where('description', 'Lancement d\'inscription')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$planification) {
            throw new \Exception("Aucune planification d'inscription trouvée.");
        }

        // 🔹 Récupérer la dernière année académique
        $anneeAcademique = AnneeAcademique::orderBy('id', 'desc')->first();

        if (!$anneeAcademique) {
            throw new \Exception("Aucune année académique trouvée.");
        }

        // 🔹 Récupérer les demandes valides (sans handicap, non classées, liées à l’année académique)
        $demandes = Demande::where('planification_id', $planification->id)
            ->whereHas('planification', function ($query) use ($anneeAcademique) {
                $query->where('annee_academique_id', $anneeAcademique->id);
            })
            ->whereHas('etudiant', function ($query) {
                $query->where('handicap', false);
            })
            ->whereDoesntHave('classement')
            ->inRandomOrder() // 🔸 Mélange aléatoire
            ->get();

        if ($demandes->isEmpty()) {
             return redirect()->back()->with('error', 'Aucune demande éligible trouvée pour la répartition.');
        }

        // 🔹 Récupérer les cabines disponibles
        $cabines = Cabine::where('places_disponibles', '>', 0)
            ->with('batiment')
            ->get();

        if ($cabines->isEmpty()) {
             return redirect()->back()->with('error', 'Aucune cabine disponible trouvée.');
        }

        // 🔹 Répartition aléatoire
        foreach ($demandes as $demande) {
            // 🔸 Trouver une cabine du même sexe
            $cabineAttribuee = $cabines->first(function ($cabine) use ($demande) {
                return $cabine->batiment->sexe === $demande->etudiant->sexe && $cabine->places_disponibles > 0;
            });

            if ($cabineAttribuee) {
                // 🔹 Créer le classement
                Classement::create([
                    'code_suivi'   => $demande->code_suivi,
                    'cabine_id'    => $cabineAttribuee->id,
                    'est_valide'   => false,
                    'caissiere_id' => null,
                ]);

                // 🔹 Décrémenter les places disponibles
                $cabineAttribuee->decrement('places_disponibles');

                // 🔸 Retirer la cabine si elle est pleine
                if ($cabineAttribuee->places_disponibles <= 0) {
                    $cabines = $cabines->reject(fn($c) => $c->id === $cabineAttribuee->id);
                }
            }
        }
    });

    return redirect()->route('classements.index')->with('success', 'Répartition faite avec succès.');
}


}


