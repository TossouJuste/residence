<?php

namespace App\Http\Controllers;

use App\Models\Classement; // Assure-toi d'inclure le modèle Demande
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    // Méthode pour afficher la page de validation
    public function validation($code_suivi)
    {
        // Rechercher la demande correspondante au code_suivi
        $classement = Classement::where('code_suivi', $code_suivi)->first();

        // Si aucune demande n'est trouvée, rediriger avec un message d'erreur
        if (!$classement) {
            return redirect()->back()->with('error', 'Aucune demande trouvée avec ce code de suivi.');
        }

        // Si la demande est trouvée, afficher la vue de validation
        return view('vitrine.validation', compact('classement'));
    } 
    
    // Valider la quittance
    public function validerQuittance($code_suivi)
    {
        // Chercher le classement correspondant au code_suivi
        $classement = Classement::where('code_suivi', $code_suivi)->first();

        if (!$classement) {
            return redirect()->back()->with('error', 'Aucun classement trouvé pour ce code de suivi.');
        }

        // Afficher la page validecaisse avec les données du classement
        return view('vitrine.validecaisse', compact('classement'));
    }
     
    public function storeQuittance(Request $request, $code_suivi)
    {
    // Valider les entrées
    $request->validate([
        'code_quittance' => 'required|string|max:255',
        'photo_quittance' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Trouver le classement en fonction du code_suivi
    $classement = Classement::where('code_suivi', $code_suivi)->first();

    if (!$classement) {
        return redirect()->back()->with('error', 'Aucun classement trouvé pour ce code de suivi.');
    }

    // Enregistrer la photo dans le dossier 'public/quittances'
    if ($request->hasFile('photo_quittance')) {
        $photoPath = $request->file('photo_quittance')->store('quittances', 'public');
    } else {
        return back()->with('error', 'Veuillez uploader une photo valide.');
    }

    // Mettre à jour le classement avec les informations de la quittance
    $classement->update([
        'code_quittance' => $request->input('code_quittance'),
        'photo_quittance' => $photoPath,
        'validation_quittance' => false, // Cette validation sera faite par l'admin plus tard
    ]);

    return redirect()->route('validation', ['code_suivi' => $classement->code_suivi])
                        ->with('success', 'Informations enregistrées avec succès.');
    }
    
     // Valider la quittance
     public function validerRecuLoyer($code_suivi)
     {
         // Chercher le classement correspondant au code_suivi
         $classement = Classement::where('code_suivi', $code_suivi)->first();
 
         if (!$classement) {
             return redirect()->back()->with('error', 'Aucun classement trouvé pour ce code de suivi.');
         }
 
         // Afficher la page validecaisse avec les données du classement
         return view('vitrine.confirmeloyer', compact('classement'));
     }

     public function storeRecu(Request $request, $code_suivi)
     {
         // Validation des données du formulaire
         $request->validate([
             'numero_recu_loyer' => 'required|string',
             'photo_recu_loyer' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // fichier image requis
             'photo_identite' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // fichier image requis
         ]);
     
         // Rechercher le classement à partir du code_suivi passé dans la route
         $classement = Classement::where('code_suivi', $code_suivi)->first();
     
         if (!$classement) {
             return redirect()->back()->with('error', 'Classement introuvable.');
         }
     
         // Gestion des fichiers uploadés
         $photoRecuPath = $request->file('photo_recu_loyer')->store('photos_recus', 'public');
         $photoIdentitePath = $request->file('photo_identite')->store('photos_identites', 'public');
     
         // Mise à jour des champs dans la base de données
         $classement->numero_recu_loyer = $request->input('numero_recu_loyer');
         $classement->photo_recu_loyer = $photoRecuPath;
         $classement->photo_identite = $photoIdentitePath;
         $classement->save();
     
         return redirect()->route('validation', ['code_suivi' => $classement->code_suivi])
                            ->with('success', 'Informations enregistrées avec succès.');
     }
     
}

