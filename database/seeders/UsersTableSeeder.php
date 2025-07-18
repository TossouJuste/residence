<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AnneeAcademique;
use App\Models\Planification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // --- Création des utilisateurs ---
        // Admin
        User::create([
            'name' => 'Administrateur Principal',
            'email' => 'admin@residence.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Intendant
        $intendant = User::create([
            'name' => 'Intendant',
            'email' => 'intendant@residence.com',
            'password' => Hash::make('password'),
            'role' => 'intendant',
            'email_verified_at' => now(),
        ]);

        // Caissière
        User::create([
            'name' => 'Marielle - Caissière',
            'email' => 'caissiere@residence.com',
            'password' => Hash::make('password'),
            'role' => 'caissiere',
            'email_verified_at' => now(),
        ]);

        // Chef de Cité
        User::create([
            'name' => 'Justin - Chef Cité',
            'email' => 'chef.cite@residence.com',
            'password' => Hash::make('password'),
            'role' => 'chef_cite',
            'email_verified_at' => now(),
        ]);

        // Chef de Bâtiment
        User::create([
            'name' => 'Jules - Chef Bâtiment',
            'email' => 'chef.batiment@residence.com',
            'password' => Hash::make('password'),
            'role' => 'chef_batiment',
            'email_verified_at' => now(),
        ]);

        // --- Création de l'année académique ---
        $anneeAcademique = AnneeAcademique::create([
            'nom' => '2024-2025',
            'date_debut' => Carbon::create(2024, 9, 1),
            'date_fin' => Carbon::create(2025, 7, 31),
        ]);

        // --- Création des planifications ---
        Planification::create([
            'annee_academique_id' => $anneeAcademique->id,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addWeeks(2),
            'statut' => 'ouverte',
            'description' => 'Lancement d\'inscription',
            'cree_par' => $intendant->id,
        ]);

        Planification::create([
            'annee_academique_id' => $anneeAcademique->id,
            'date_debut' => Carbon::now()->addMonths(3),
            'date_fin' => Carbon::now()->addMonths(3)->addWeeks(1),
            'statut' => 'fermée',
            'description' => 'Résultat',
            'cree_par' => $intendant->id,
        ]);
    }
}
