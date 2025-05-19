<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Demande;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DemandeSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Assure-toi qu'il y a une planification avec statut "ouverte"
        $planification = \App\Models\Planification::where('statut', 'ouverte')->first();

        if (!$planification) {
            $this->command->warn('Aucune planification ouverte trouvée.');
            return;
        }

        for ($i = 0; $i < 500; $i++) {
            Demande::create([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'telephone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'date_naissance' => $faker->date('Y-m-d', '2004-01-01'),
                'lieu_naissance' => $faker->randomElement(['BOPA', 'ABOMEY CALAVI', 'POBE', 'SAVE'], 'ABOMEY', 'BOHICON', 'OUIDAH', 'COVE', 'N\'DALI', 'KETOU', 'PORTO-NOVO', 'SAKETE', 'SAXWE', 'TORI', 'ADJA', 'PARAKOU', 'GOGOUNOU', 'HEVIE'),
                'domicile' => $faker->address,
                'etablissement' => $faker->randomElement(['IFRI', 'EPAC', 'INE', 'FASEG'], 'FASH', 'FLLAC', 'FADESP', 'FSA', 'ENA', 'ENEAM'),
                'filiere' => $faker->word,
                'annee_etude' => $faker->randomElement(['1ère année', '2ème année', '3ème année']),
                'sexe' => $faker->randomElement(['M', 'F']),
                'nationalite' => $faker->country,
                'adresse_personnelle' => $faker->address,
                'fiche_inscription' => 'fichiers/fiches_inscriptions/fake_file_' . uniqid() . '.png',
                'adresse_residence_parents' => $faker->address,
                'statut_aide' => $faker->randomElement(['boursier', 'secouru', 'aucun']),
                'ancien_resident' => $faker->boolean,
                'batiments' => $faker->optional()->word,
                'redoublant' => $faker->boolean,
                'handicap' => $faker->boolean,
                'type_handicap' => $faker->boolean ? $faker->word : null,
                'code_suivi' => strtoupper(uniqid('REQ')),
                'statut' => 'En cours de traitement',
                'planification_id' => $planification->id,
            ]);
        }
    }
}
