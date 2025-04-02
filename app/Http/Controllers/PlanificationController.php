<?php

namespace App\Http\Controllers;

use App\Models\Planification;
use App\Models\AnneeAcademique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PlanificationController extends Controller
{
    /**
     * Afficher la liste des planifications.
     */
    public function index()
    {
        $planifications = Planification::orderBy('id', 'desc')->paginate(10); // Ajoute paginate(10)
        return view('pages.planifications.index', compact('planifications'));
    }


    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        $anneesAcademiques = AnneeAcademique::all();
        return view('pages.planifications.create', compact('anneesAcademiques'));
    }

    /**
     * Enregistrer une nouvelle planification.
     */
    public function store(Request $request)
    {
        $request->validate([
            'annee_academique_id' => 'required|exists:annees_academiques,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'description' => 'required|in:Lancement d\'inscription,Résultat',
        ]);

        Planification::create([
            'annee_academique_id' => $request->annee_academique_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'statut' => 'fermée', // Change selon tes besoins
             'description' => $request->description,
            'cree_par' => Auth::id(),
        ]);

        return redirect()->route('planifications.index')->with('success', 'Planification ajoutée avec succès !');
    }

    /**
     * Afficher une planification spécifique.
     */
    public function show(Planification $planification)
    {
        return view('pages.planifications.show', compact('planification'));
    }

    /**
     * Afficher le formulaire d'édition.
     */
    public function edit(Planification $planification)
    {
        $anneesAcademiques = AnneeAcademique::all();
        return view('pages.planifications.edit', compact('planification', 'anneesAcademiques'));
    }

    /**
     * Mettre à jour une planification.
     */
    public function update(Request $request, Planification $planification)
{
    // 🔹 Validation des champs
    $request->validate([
        'annee_academique_id' => 'required|exists:annees_academiques,id',
        'date_debut' => 'required|date|after_or_equal:today',
        'date_fin' => 'required|date|after:date_debut',
        'description' => 'nullable|string',
        'statut' => 'required|in:ouverte,fermée', // 🔹 Validation du statut
    ]);

    // 🔹 Mise à jour de la planification
    $planification->update([
        'annee_academique_id' => $request->annee_academique_id,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'description' => $request->description,
        'statut' => $request->statut, // 🔹 Ajout du statut
    ]);

    // 🔹 Redirection avec message de succès
    return redirect()->route('planifications.index')->with('success', 'Planification mise à jour avec succès !');
}


    /**
     * Supprimer une planification.
     */
    public function destroy(Planification $planification)
    {
        if ($planification->delete()) {
            return redirect()->route('planifications.index')->with('success', 'Planification supprimée avec succès !');
        }

        return redirect()->route('planifications.index')->with('error', 'Erreur lors de la suppression de la planification.');
    }
}
