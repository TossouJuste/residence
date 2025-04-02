<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classement;
use App\Models\Demande;
use App\Models\User;
use App\Models\AnneeAcademique;
use App\Models\Cabine;
use Illuminate\Support\Facades\Auth;


class ClassementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class)
            ->except(['valider']); // Désactiver CSRF uniquement pour cette méthode
    }

    /**
     * Afficher les détails du classement pour une demande.
     */
    public function afficherClassement($code_suivi)
    {
        // Rechercher la demande associée
        $demande = Demande::where('code_suivi', $code_suivi)->firstOrFail();

        // Rechercher le classement et charger les relations
        $classement = Classement::with(['cabine.batiment.city'])
            ->where('code_suivi', $code_suivi)
            ->firstOrFail();

        // Retourner la vue avec les informations
        return view('vitrine.infodemande', compact('demande', 'classement'))
            ->with('statut', $demande->statut);
    }

    /**
     * Liste des classements en fonction du rôle de l'utilisateur.
     */
    public function index(Request $request)
    {
        // Récupérer la dernière année académique créée
        $latestAcademicYear = \App\Models\AnneeAcademique::latest()->first();

        // Vérifier si une année académique existe
        if (!$latestAcademicYear) {
            return redirect()->back()->with('error', 'Aucune année académique trouvée.');
        }

        // Récupérer l'année académique sélectionnée (par défaut, la dernière créée)
        $academicYearId = $request->input('academic_year_id', $latestAcademicYear->id);

        // Récupérer les classements en passant par Demande et Planification
        $classements = \App\Models\Classement::whereHas('demande.planification', function ($query) use ($academicYearId) {
            $query->where('annee_academique_id', $academicYearId)
                  ->where('description', 'Lancement d\'inscription'); // Filtrer sur la planification
        })->paginate(10);

        // Récupérer toutes les années académiques disponibles pour le filtre
        $academicYears = \App\Models\AnneeAcademique::orderBy('id', 'desc')->get();

        return view('pages.classements.index', compact('classements', 'academicYearId', 'academicYears'));
    }



    /**
     * Afficher le formulaire de création d'un classement.
     */
    public function create()
    {
        // Récupérer la dernière année académique
        $latestAcademicYear = AnneeAcademique::latest()->first();

        // Si aucune année académique n'est trouvée
        if (!$latestAcademicYear) {
            return redirect()->back()->with('error', 'Aucune année académique trouvée.');
        }

        // Récupérer uniquement les demandes de la dernière année académique qui ne sont PAS classées
        $demandes = Demande::whereHas('planification', function ($query) use ($latestAcademicYear) {
            $query->where('annee_academique_id', $latestAcademicYear->id);
        })
        ->whereDoesntHave('classement', function ($query) {
            $query->whereColumn('demandes.code_suivi', 'classements.code_suivi');
        }) // Exclure les demandes déjà classées
        ->get();

        // Récupérer uniquement les cabines avec des places disponibles > 0
        $cabines = Cabine::where('places_disponibles', '>', 0)->get();

        return view('pages.classements.create', compact('demandes', 'cabines'));
    }




    public function store(Request $request)
{
    $validatedData = $request->validate([
        'code_suivi' => 'required|string|exists:demandes,code_suivi',
        'cabine_id' => 'required|exists:cabines,id',
    ]);

    // Vérifier si la demande est déjà classée
    if (Classement::where('code_suivi', $validatedData['code_suivi'])->exists()) {
        return redirect()->back()->with('error', 'Cette demande est déjà classée.');
    }

    // Vérifier que la cabine a encore des places disponibles
    $cabine = Cabine::findOrFail($validatedData['cabine_id']);
    if ($cabine->places_disponibles <= 0) {
        return redirect()->back()->with('error', 'Cette cabine est déjà complète.');
    }

    // Créer le classement avec `est_valide` à false par défaut
    Classement::create([
        'code_suivi' => $validatedData['code_suivi'], // Utiliser `code_suivi` et non `demande_id`
        'cabine_id' => $cabine->id,
        'est_valide' => false, // Par défaut, le classement n'est pas encore validé
    ]);

    // Diminuer la place disponible dans la cabine
    $cabine->decrement('places_disponibles');

    return redirect()->route('classements.index')->with('success', 'Classement créé avec succès.');
}


public function validateClassement($codeSuivi, Request $request)
{
    $classement = Classement::where('code_suivi', $codeSuivi)->first();

    if (!$classement) {
        return response()->json(['success' => false, 'message' => 'Classement introuvable.']);
    }

    if ($classement->est_valide) {
        return response()->json(['success' => false, 'message' => 'Déjà validé.']);
    }

    $classement->est_valide = true;
    $classement->caissiere_id = Auth::id(); // Enregistre l'utilisateur actuel 
    $classement->save();

    return response()->json(['success' => true]);
}


    /**
     * Afficher un classement spécifique.
     */
    public function show($code_suivi)
    {
        $classement = Classement::where('code_suivi', $code_suivi)->firstOrFail();
        $user = auth()->user();

        // Vérifier l'autorisation d'accès
        if (!in_array($user->role, ['caissiere', 'chef_cite', 'chef_batiment'])) {
            return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation d\'accéder à cette page.');
        }

        return view('pages.classements.show', compact('classement'));
    }

    /**
     * Afficher le formulaire d'édition d'un classement.
     */
    public function edit($code_suivi)
    {
        $classement = Classement::where('code_suivi', $code_suivi)->firstOrFail();
        $cabines = Cabine::where('places_disponibles', '>', 0)->get(); // Sélectionner uniquement les cabines avec des places
        return view('pages.classements.edit', compact('classement', 'cabines'));
    }


    /**
     * Mettre à jour un classement spécifique.
     */
    public function update(Request $request, $code_suivi)
    {
        $classement = Classement::where('code_suivi', $code_suivi)->firstOrFail();

        $validatedData = $request->validate([
            'cabine_id' => 'required|exists:cabines,id',
            'est_valide' => 'nullable|boolean',
        ]);

        // Vérifier si la cabine a changé
        if ($classement->cabine_id != $validatedData['cabine_id']) {
            // Récupérer l'ancienne cabine et libérer une place
            $ancienneCabine = Cabine::find($classement->cabine_id);
            if ($ancienneCabine) {
                $ancienneCabine->increment('places_disponibles');
            }

            // Vérifier que la nouvelle cabine a des places disponibles
            $nouvelleCabine = Cabine::findOrFail($validatedData['cabine_id']);
            if ($nouvelleCabine->places_disponibles <= 0) {
                return redirect()->back()->with('error', 'Cette cabine est déjà complète.');
            }

            // Attribuer la nouvelle cabine et diminuer une place
            $classement->cabine_id = $validatedData['cabine_id'];
            $nouvelleCabine->decrement('places_disponibles');
        }

        $classement->est_valide = $validatedData['est_valide'];
        $classement->save();

        return redirect()->route('classements.index')->with('success', 'Classement mis à jour avec succès.');
    }



    /**
     * Supprimer un classement.
     */
    public function destroy($code_suivi)
    {
        $classement = Classement::where('code_suivi', $code_suivi)->firstOrFail();
        $classement->delete();

        return redirect()->route('classements.index')->with('success', 'Classement supprimé avec succès.');
    }


    /**
     * Valider la quittance d'une demande.
     */
    public function valider($code_suivi)
    {
        $classement = Classement::where('code_suivi', $code_suivi)->firstOrFail();

        if ($classement->est_valide) {
            return response()->json([
                'success' => false,
                'message' => 'Ce classement est déjà validé.'
            ], 400);
        }

        $classement->update([
            'est_valide' => true, // C'est cette colonne qui doit être mise à jour
            'caissiere_id' => auth()->id(), // Enregistre l'utilisateur qui valide
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Validation réussie !'
        ]);
    }





    /**
     * Annuler la validation d'une quittance.
     */
    public function devalider($code_suivi)
    {
        $classement = Classement::where('code_suivi', $code_suivi)->firstOrFail();
        $classement->update([
            'est_valide' => false,
            'updated_at' => null
        ]);

        return redirect()->back()->with('success', 'Validation de la quittance annulée.');
    }
}
