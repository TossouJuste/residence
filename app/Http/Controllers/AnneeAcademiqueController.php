<?php

namespace App\Http\Controllers;

use App\Models\AnneeAcademique;
use App\Models\Classement;
use App\Models\Cabine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnneeAcademiqueController extends Controller
{
    /**
     * Afficher la liste des années académiques.
     */
    public function index()
    {
        $anneesAcademiques = AnneeAcademique::orderBy('nom', 'desc')->paginate(10);
        return view('pages.annees_academiques.index', compact('anneesAcademiques'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        return view('pages.annees_academiques.create');
    }

    /**
     * Enregistrer une nouvelle année académique.
     * Réinitialise les places_disponibles si aucun classement n'existe encore.
     */
public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|unique:annees_academiques,nom',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after:date_debut',
    ]);

    // Création de l'année académique
    $annee = AnneeAcademique::create([
        'nom' => $request->nom,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
    ]);

    // Réinitialisation des places disponibles pour toutes les cabines
    Cabine::query()->update([
        'places_disponibles' => DB::raw('places_initiales')
    ]);

    // Invalider tous les classements non validés (est_valide != 1)
    \App\Models\Classement::where(function ($query) {
        $query->whereNull('est_valide')
              ->orWhere('est_valide', '!=', 1);
    })->update(['peut_valider' => false]);

    return redirect()->route('annees-academiques.index')->with('success', 'Année académique ajoutée avec succès !');
}


    /**
     * Afficher une année académique spécifique.
     */
    public function show($id)
    {
        $anneeAcademique = AnneeAcademique::findOrFail($id);
        return view('pages.annees_academiques.show', compact('anneeAcademique'));
    }

    /**
     * Afficher le formulaire d'édition.
     */
    public function edit(AnneeAcademique $anneeAcademique)
    {
        return view('pages.annees_academiques.edit', compact('anneeAcademique'));
    }

    /**
     * Mettre à jour une année académique.
     */
    public function update(Request $request, AnneeAcademique $anneeAcademique)
    {
        $request->validate([
            'nom' => 'required|string|unique:annees_academiques,nom,' . $anneeAcademique->id,
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        $anneeAcademique->update([
            'nom' => $request->nom,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
        ]);

        return redirect()->route('annees-academiques.index')->with('success', 'Année académique mise à jour avec succès !');
    }

    /**
     * Supprimer une année académique.
     */
    public function destroy(AnneeAcademique $anneeAcademique)
    {
        $anneeAcademique->delete();
        return redirect()->route('annees-academiques.index')->with('success', 'Année académique supprimée avec succès !');
    }
}
