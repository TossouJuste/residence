<?php

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationDemandeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;

    public function __construct($demande)
    {
        $this->demande = $demande;
    }

    public function build()
    {
        return $this->subject('Confirmation de votre demande de résidence')
                    ->view('pages/emails.demande_recu');
    }
}

