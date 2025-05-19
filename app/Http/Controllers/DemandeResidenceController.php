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

class DemandeResidenceController extends Controller
{

    public function index()
    {
        return view('vitrine.index');
    }


 public function create()
{
    // 🔹 Récupérer la dernière année académique (par exemple la plus récente)
    $anneeAcademique = \App\Models\AnneeAcademique::latest()->first();

    if (!$anneeAcademique) {
    }

    // 🔹 Récupérer la planification ouverte avec description spécifique liée à cette année
    $planification = \App\Models\Planification::where('statut', 'ouverte')
        ->where('description', 'Lancement d\'inscription')
        ->where('annee_academique_id', $anneeAcademique->id)
        ->latest()
        ->first();

    if (!$planification) {
        }

    return view('vitrine.createdemande', compact('planification'));
}



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'domicile' => 'required|string|max:255',
            'etablissement' => 'required|string|max:255',
            'filiere' => 'required|string|max:255',
            'annee_etude' => 'required|string|max:255',
            'fiche_inscription' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10000',  // pour accepter les fichiers pdf, jpg, jpeg, png
            'sexe' => 'required|string|max:10',
            'nationalite' => 'required|string|max:255',
            'adresse_personnelle' => 'required|string|max:255',
            'adresse_residence_parents' => 'required|string|max:255',
            'statut_aide' => 'required|in:boursier,secouru,aucun',
            'ancien_resident' => 'required|boolean',
            'batiments' => 'nullable|string|max:255',
            'redoublant' => 'required|boolean',
            'handicap' => 'required|boolean',
            'type_handicap' => 'nullable|string|max:255',
            'certificat_handicap' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10000',  // fichier pour le certificat de handicap
        ]);

        // Vérifier s'il existe une planification en cours
        $planification = \App\Models\Planification::where('statut', 'ouverte')->where('description','Lancement d\'inscription')->latest()->first();

        // si aucune planification ouverte, on empêche l'enregistrement
        if(!$planification){
            return redirect()->back()->with('error', 'Aucune planification en cours. Veuillez réessayer plus tard');
        }

        // Associer la demande à la planification existante
        $validatedData['planification_id'] = $planification->id ;

        // Vérification d'une demande déjà existante cette année
        $demandeExistante = Demande::where('nom', $validatedData['nom'])
            ->where('prenom', $validatedData['prenom'])
            ->where('date_naissance', $validatedData['date_naissance'])
            ->where('planification_id', $validatedData['planification_id'])
            ->first();
        if ($demandeExistante) {
            return redirect()->back()->with('error', 'Vous avez déjà soumis une demande cette année.');
        }


        // Générer un code de suivi unique
        $validatedData['code_suivi'] = strtoupper(uniqid('REQ'));

        //Statut
        $validatedData['statut'] = 'En cours de traitement';

        // Stocker la demande
        $demande = Demande::create($validatedData);

         Mail::to($demande->email)->send(new DemandeRecue($demande, $validatedData['code_suivi']));

        return redirect()->route('demandes.confirmation', ['code_suivi' => $demande->code_suivi]);
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

            // 🔹 Vérifier que la planification appartient à la dernière année académique
            $anneeAcademique = AnneeAcademique::orderBy('id', 'desc')->first(); // ou 'created_at' selon le modèle

            if (!$anneeAcademique) {
            throw new \Exception("Aucune année académique trouvée.");
            }

            // 🔹 Récupérer les demandes éligibles (pas encore classées), sans handicap et liées à l'année académique courante
            $demandes = Demande::where('planification_id', $planification->id)
            ->whereHas('planification', function ($query) use ($anneeAcademique) {
             $query->where('annee_academique_id', $anneeAcademique->id);
            })
            ->where('handicap', false) // Supposons que ce champ indique la situation de handicap (booléen)
            ->whereDoesntHave('classement') // Exclure celles déjà classées
            ->get();

            if ($demandes->isEmpty()) {
            throw new \Exception("Aucune demande éligible trouvée.");
            }

            // 🔹 Calculer le score pour chaque demande
            $demandes = $demandes->map(function ($demande) {
                $score = 0;

                // Critère 1 : Âge (plus jeune = meilleur score)
                $age = now()->diffInYears($demande->date_naissance);
                $score += (100 - $age); // Moins on est âgé, plus le score est élevé.

                // Critère 2 : Ancienneté en cabine
                if ($demande->ancien_resident) {
                    $score -= 20; // Malus si déjà résident.
                }

                // Critère 3 : Statut financier
                if ($demande->boursier || $demande->secouru) {
                    $score += 20; // Bonus pour étudiants en difficulté financière.
                } elseif ($demande->salarie) {
                    $score -= 50; // Malus pour les salariés.
                }

                // Critère 4 : Redoublement
                if ($demande->redoublant) {
                    $score -= 20; // Malus si redoublant.
                }

                // Sauvegarde du score temporaire (non en BDD)
                $demande->score = $score;
                return $demande;
            });

            // 🔹 Trier les demandes par score décroissant
            $demandes = $demandes->sortByDesc('score');

            // 🔹 Récupérer les cabines disponibles
            $cabines = Cabine::where('places_disponibles', '>', 0)->with('batiment')->get();

            if ($cabines->isEmpty()) {
                throw new \Exception("Aucune cabine disponible.");
            }

            // 🔹 Répartition des cabines
            foreach ($demandes as $demande) {
                // Trouver une cabine du même sexe
                $cabineAttribuee = $cabines->first(function ($cabine) use ($demande) {
                    return $cabine->batiment->sexe === $demande->sexe && $cabine->places_disponibles > 0;
                });

                if ($cabineAttribuee) {
                    // 🔹 Créer le classement
                    Classement::create([
                        'code_suivi' => $demande->code_suivi,
                        'cabine_id' => $cabineAttribuee->id,
                        'est_valide' => false, // Non validé par défaut
                        'caissiere_id' => null
                    ]);

                    // 🔹 Décrémenter les places disponibles
                    $cabineAttribuee->decrement('places_disponibles');

                    // 🔹 Supprimer cette cabine si pleine
                    if ($cabineAttribuee->places_disponibles <= 0) {
                        $cabines = $cabines->reject(fn($c) => $c->id === $cabineAttribuee->id);
                    }
                }
            }
        });

        return redirect()->route('classements.index')->with('success', 'Répartition faite avec succès.');
    }
}


