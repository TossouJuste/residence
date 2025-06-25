<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;

class EtablissementController extends Controller
{
    public function index()
    {
        $etablissements = Etablissement::paginate(10);
        return view('pages.etablissements.index', compact('etablissements'));
    }

    public function create()
    {
        return view('pages.etablissements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'nom' => 'required|unique:etablissements,nom',
        ]);

        Etablissement::create($request->all());

        return redirect()->route('etablissements.index')->with('success', 'Établissement ajouté.');
    }

    public function edit(Etablissement $etablissement)
    {
        return view('pages.etablissements.edit', compact('etablissement'));
    }

    public function update(Request $request, Etablissement $etablissement)
    {
        $request->validate([
            'type' => 'required',
             'nom' => 'required|unique:etablissements,nom,' . $etablissement->id,
        ]);

        $etablissement->update($request->all());

        return redirect()->route('etablissements.index')->with('success', 'Établissement modifié.');
    }

     public function show($id)
     {
         $etablissement = Etablissement::findOrFail($id);
         return view('pages.etablissements.show', compact('etablissement'));
     }

    public function destroy(Etablissement $etablissement)
    {
        $etablissement->delete();
        return redirect()->route('etablissements.index')->with('success', 'Établissement supprimé.');
    }
}
