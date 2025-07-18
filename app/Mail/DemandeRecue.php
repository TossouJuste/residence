<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class DemandeRecue extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $codeSuivi;

    /**
     * Crée une nouvelle instance du message.
     */
    public function __construct($demande, $codeSuivi)
    {
        $this->demande = $demande;
        $this->codeSuivi = $codeSuivi;
    }

    /**
     * Construire le message.
     */
    public function build()
    {
        // Générer le PDF à partir d’une vue (à créer)
        $pdf = Pdf::loadView('pdf.recapitulatif', [ // Crée cette vue à part
            'demande' => $this->demande,
            'codeSuivi' => $this->codeSuivi,
        ]);

        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject('Confirmation de votre demande')
                    ->view('pages.emails.demande_recu')
                    ->with([
                        'nom' => $this->demande->etudiant->nom ?? 'Candidat(e)',
                        'email' => $this->demande->etudiant->email ?? '',
                        'codeSuivi' => $this->codeSuivi,
                    ])
                    ->attachData(
                        $pdf->output(),
                        'Recapitulatif_demande_'.$this->codeSuivi.'.pdf',
                        ['mime' => 'application/pdf']
                    );
    }
}
