<?php

namespace App\Http\Controllers;

use App\Models\Cabine;
use App\Models\Batiment;
use Illuminate\Http\Request;

class CabineController extends Controller
{
    public function index()
    {
        $cabines = Cabine::with('batiment')->paginate(10);
        return view('pages.cabines.index', compact('cabines'));
    }

    public function create()
    {
        $batiments = Batiment::all();
        return view('pages.cabines.create', compact('batiments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:cabines,code',
            'batiment_id' => 'required|exists:batiments,id',
            'places_initiales' => 'required|integer|min:0',
        ]);

        // Créer la cabine avec places_initiales et places_disponibles initialisées
        Cabine::create([
            'code' => $request->code,
            'batiment_id' => $request->batiment_id,
            'places_initiales' => $request->places_initiales,
            'places_disponibles' => $request->places_initiales,  // Initialisation de places_disponibles avec places_initiales
        ]);

        return redirect()->route('cabines.index')->with('success', 'Cabine ajoutée avec succès.');
    }


    public function show(Cabine $cabine)
    {
        return view('pages.cabines.show', compact('cabine'));
    }

    public function edit(Cabine $cabine)
    {
        $batiments = Batiment::all();
        return view('pages.cabines.edit', compact('cabine', 'batiments'));
    }

    public function update(Request $request, Cabine $cabine)
    {
        $request->validate([
            'code' => 'required|string|unique:cabines,code,' . $cabine->id,
            'batiment_id' => 'required|exists:batiments,id',
            'places_initiales' => 'required|integer|min:0', 
        ]);

        $cabine->update($request->only([
            'code',
            'batiment_id',
            'place_initiale',
            'places_disponibles'
        ]));

        return redirect()->route('cabines.index')->with('success', 'Cabine mise à jour avec succès.');
    }

    public function destroy(Cabine $cabine)
    {
        $cabine->delete();
        return redirect()->route('cabines.index')->with('success', 'Cabine supprimée avec succès.');
    }
}
