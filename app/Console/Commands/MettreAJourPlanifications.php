<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Planification;
use Carbon\Carbon;

class MettreAJourPlanifications extends Command
{
    protected $signature = 'planifications:mettre-a-jour';
    protected $description = 'Met à jour le statut des planifications selon les dates définies';

    public function handle()
    {
        $now = Carbon::now();

        // Ouvrir les planifications dont la date_debut est atteinte et qui sont encore fermées
        Planification::where('date_debut', '<=', $now)
            ->where('statut', 'fermé')
            ->update(['statut' => 'ouvert']);

        // Fermer les planifications dont la date_fin est atteinte et qui sont encore ouvertes
        Planification::where('date_fin', '<=', $now)
            ->where('statut', 'ouvert')
            ->update(['statut' => 'fermé']);

        $this->info('Mise à jour des planifications effectuée.');
    }
}

