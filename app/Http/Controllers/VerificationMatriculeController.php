<?php

namespace App\Http\Controllers;

use App\Models\BaseUac;
use App\Models\VerificationMatricule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\CodeVerificationMail;

class VerificationMatriculeController extends Controller
{
    public function showForm()
    {
        // Si l'étudiant a déjà vérifié son matricule, on le redirige directement vers le formulaire de demande
        if (session()->has('matricule_verifie')) {
            return redirect()->route('demandes.create')->with('info', 'Vous avez déjà vérifié votre matricule.');
        }

        // Sinon, on lui affiche le formulaire de vérification
        return view('vitrine.verif-mat');
    }
 
    public function handleMatricule(Request $request)
    {
        $request->validate([
            'matricule' => 'required|exists:base_uacs,matricule',
        ]);

        $matricule = $request->matricule;

        // Récupération de l'étudiant dans BaseUac
        $baseUac = BaseUac::where('matricule', $matricule)->first();

        // Vérification si un code existe déjà
        $verif = VerificationMatricule::where('matricule', $matricule)->first();

        if ($verif) {
            return back()->with([
                'message' => 'Veuillez saisir votre code de vérification reçu par mail.',
                'show_code' => true,
                'matricule' => $matricule
            ]);
        }

        // Génération d'un nouveau code
        $code = strtoupper(Str::random(6));

        // Sauvegarde dans la table de vérification
        VerificationMatricule::create([
            'matricule' => $matricule,
            'email' => $baseUac->email_uac,
            'code_verification' => $code,
             'base_uac_id' => $baseUac->id,
        ]);

        // Envoi du mail contenant le code
       Mail::to($baseUac->email_uac)->send(new CodeVerificationMail($code));

        return back()->with([
            'message' => "Un mail contenant votre code a été envoyé à l'adresse suivante : {$baseUac->email_uac}.",
            'show_code' => true,
            'matricule' => $matricule
        ]);
    }


    public function verifyCode(Request $request)
    {
        $request->validate([
            'matricule' => 'required',
            'code_verification' => 'required'
        ]);

        $verif = VerificationMatricule::where('matricule', $request->matricule)
            ->where('code_verification', $request->code_verification)
            ->first();

        if ($verif) {
            session(['matricule_verifie' => $request->matricule]);
            return redirect()->route('demandes.create')->with('success', 'Code vérifié, vous pouvez faire votre demande.');
        }

        return back()->with('error', 'Code incorrect, veuillez réessayer.')->withInput();
    }
}
