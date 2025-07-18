<?php

namespace App\Http\Controllers;
use App\Models\BaseUac;
use Illuminate\Http\Request;

class BaseUacController extends Controller
{

    public function index()
    {
        $etudiants = BaseUac::latest()->paginate(10); 
        return view('pages.BaseUac.index', compact('etudiants'));
    }

    public function create()
    {
        return view('pages.BaseUac.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'matricule' => 'required|unique:base_uacs,matricule',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email_uac' => 'required|email|unique:base_uacs,email_uac',

            // ajoute d'autres champs si nécessaires
        ]);

        BaseUac::create([
            'matricule' => $request->matricule,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email_uac' => $request->email_uac,
        ]);

        return back()->with('success', 'Étudiant ajouté dans Base UAC avec succès.');
    }
}
