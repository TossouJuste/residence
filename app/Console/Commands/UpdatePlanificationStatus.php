<?php 

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Planification;
use Carbon\Carbon;

class UpdatePlanificationStatus extends Command
{
    protected $signature = 'planification:update-status';
    protected $description = 'Met à jour le statut des planifications en fonction de la date actuelle';

    public function handle()
    {
        $now = Carbon::now();

        // Ouvrir les planifications dont la date_debut est atteinte
        Planification::where('statut', 'fermée')
            ->where('date_debut', '<=', $now)
            ->where('date_fin', '>', $now)
            ->update(['statut' => 'ouverte']);

        // Fermer les planifications dont la date_fin est atteinte
        Planification::where('statut', 'ouverte')
            ->where('date_fin', '<=', $now)
            ->update(['statut' => 'fermée']);

        $this->info("Mise à jour des planifications effectuée !");
    }
}

