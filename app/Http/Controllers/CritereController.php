<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use Illuminate\Http\Request;

class CritereController extends Controller
{
    // Liste des critères
    public function index()
    {
        $criteres = Critere::all();
        return view('pages.criteres.index', compact('criteres'));
    }

    // Formulaire de création
    public function create()
    {
        return view('pages.criteres.create');
    }

    // Enregistrement d'un nouveau critère
    public function store(Request $request)
    {
        $request->validate([
            'code_critere' => 'required|unique:criteres',
            'libelle' => 'required',
        ]);

        Critere::create($request->all());

        return redirect()->route('pages.criteres.index')->with('success', 'Critère ajouté avec succès');
    }

    // Afficher un critère spécifique
    public function show(Critere $critere)
    {
        return view('pages.criteres.show', compact('critere'));
    }

    // Formulaire d'édition
    public function edit(Critere $critere)
    {
        return view('pages.criteres.edit', compact('critere'));
    }

    // Mettre à jour un critère existant
    public function update(Request $request, Critere $critere)
    {
        $request->validate([
            'code_critere' => 'required|unique:criteres,code_critere,' . $critere->id,
            'libelle' => 'required',
        ]);

        $critere->update($request->all());

        return redirect()->route('pages.criteres.index')->with('success', 'Critère mis à jour avec succès');
    }

    // Supprimer un critère
    public function destroy(Critere $critere)
    {
        $critere->delete();

        return redirect()->route('pages.criteres.index')->with('success', 'Critère supprimé avec succès');
    }
}
