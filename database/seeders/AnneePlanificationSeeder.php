<?php

use Illuminate\Database\Seeder;
use App\Models\AnneeAcademique;
use App\Models\Planification;
use App\Models\User;
use Carbon\Carbon;

class AnneePlanificationSeeder extends Seeder
{
    public function run()
    {
        // Vérifier ou créer un utilisateur (intendant)
        $user = User::first(); // ou User::where('role', 'intendant')->first();

        if (!$user) {
            $user = User::create([
                'name' => 'Intendant Général',
                'email' => 'intendant@example.com',
                'password' => bcrypt('password'), // change-le pour la prod
                'role' => 'intendant', // si tu as un champ 'role'
            ]);
        }

        // Créer l’année académique
        $annee = AnneeAcademique::create([
            'libelle' => '2024-2025',
            'date_debut' => Carbon::create(2024, 9, 1),
            'date_fin' => Carbon::create(2025, 7, 31),
        ]);

        // Créer une planification liée à l’année, statut "ouverte"
        Planification::create([
            'annee_academique_id' => $annee->id,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addWeeks(2),
            'statut' => 'ouverte',
            'description' => 'Lancement d\'inscription',
            'cree_par' => $user->id,
        ]);
    }
}
