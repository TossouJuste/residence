<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Administrateur Principal',
            'email' => 'admin@residence.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        // Intendant
        User::create([
            'name' => 'Intendant Général',
            'email' => 'intendant@residence.com',
            'password' => Hash::make('password'),
            'role' => 'intendant',
            'email_verified_at' => now(),
        ]);

        // Caissière
        User::create([
            'name' => 'Marie Dupont - Caissière',
            'email' => 'caissiere@residence.com',
            'password' => Hash::make('password'),
            'role' => 'caissiere',
            'email_verified_at' => now(),
        ]);

        // Chef de Cité
        User::create([
            'name' => 'Paul Martin - Chef Cité',
            'email' => 'chef.cite@residence.com',
            'password' => Hash::make('password'),
            'role' => 'chef_cite',
            'email_verified_at' => now(),
        ]);

        // Chef de Bâtiment
        User::create([
            'name' => 'Julie Leroy - Chef Bâtiment',
            'email' => 'chef.batiment@residence.com',
            'password' => Hash::make('password'),
            'role' => 'chef_batiment',
            'email_verified_at' => now(),
        ]);


    }
}
