<?php
 
namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        // Création d'un utilisateur 'demo' avec le rôle 'Intendant'
        $demoUser = User::create([
            'name'              => $faker->name,
            'email'             => 'demo@demo1.com',
            'password'          => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);
        $demoUser->assignRole('Intendant'); // Assigner le rôle 'Intendant'

        // Création d'un utilisateur 'admin' avec le rôle 'Admin'
        $demoUser2 = User::create([
            'name'              => $faker->name,
            'email'             => 'admin@demo.com',
            'password'          => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);
        $demoUser2->assignRole('Admin'); // Assigner le rôle 'Admin'

        // (Optionnel) Création d'un utilisateur 'caissière' avec le rôle 'Caissière'
        $caissiereUser = User::create([
            'name'              => $faker->name,
            'email'             => 'caissiere@demo.com',
            'password'          => Hash::make('demo'),
            'email_verified_at' => now(),
        ]);
        $caissiereUser->assignRole('Caissière'); // Assigner le rôle 'Caissière'
    }
}
