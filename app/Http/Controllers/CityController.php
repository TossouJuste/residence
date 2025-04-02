<?php

namespace App\Http\Controllers;
use App\Models\City;


use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        // Récupère 1 cités par page
        $cities = City::paginate(10);

        return view('pages.cities.index', compact('cities'));
    }

     // Méthode pour afficher le formulaire d'édition
     public function edit($id)
     {
         $city = City::findOrFail($id);
         return view('pages.cities.edit', compact('city'));
     }

     // Méthode pour mettre à jour une cité
     public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'nbr_batiment' => 'required|integer',
            'description' => 'nullable|string|max:1000',
        ]);

     $city = City::findOrFail($id);
     $city->update($request->except(['_token', '_method']));

        return redirect()->route('cities.index')->with('success', 'Cité mise à jour avec succès.');
    }

     // Méthode pour afficher les détails d'une cité
     public function show($id)
     {
         $city = City::findOrFail($id);
         return view('pages.cities.show', compact('city'));
     }


     public function destroy($id)
    {
        // Trouver la cité par son ID
        $city = City::findOrFail($id);

        // Supprimer la cité
        $city->delete();

        // Rediriger avec un message de succès
        return redirect()->route('cities.index')->with('success', 'Cité supprimée avec succès.');
    }

    public function create()
{
    // Afficher le formulaire de création
    return view('pages.cities.create');
}

public function store(Request $request)
{
    // Valider les données du formulaire
    $request->validate([
        'nom' => 'required|string|max:255',
        'nbr_batiment' => 'required|integer',
        'description' => 'nullable|string|max:1000',
    ]);

    // Créer une nouvelle cité
    City::create($request->all());

    // Rediriger avec un message de succès
    return redirect()->route('cities.index')->with('success', 'Cité créée avec succès.');
}



}


