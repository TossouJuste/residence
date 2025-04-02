<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandeRecue extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $code_suivi;

    /**
     * Crée une nouvelle instance du message.
     */
    public function __construct($demande, $code_suivi)
    {
        $this->demande = $demande;
        $this->codeSuivi = $code_suivi;
    }

    /**
     * Construire le message.
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject('Confirmation de votre demande')
                    ->view('pages/emails.demande_recu')
                    ->with([
                        'nom' => $this->demande->nom,
                        'email' => $this->demande->email,
                        'codeSuivi' => $this->codeSuivi,
                    ]);
    }
}
