<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BaseUac;
use App\Models\VerificationMatricule;
use App\Models\Etudiant;
use App\Models\Demande;
use App\Models\Etablissement;
use App\Models\Planification;
use Faker\Factory as Faker;

class DemandeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('fr_FR');

        // 1. Créer les établissements si non présents
        $etablissements = [
            ['nom' => 'FASEG', 'type' => 'Faculté'],
            ['nom' => 'FADESP', 'type' => 'Faculté'],
            ['nom' => 'FAST', 'type' => 'Faculté'],
            ['nom' => 'FASH', 'type' => 'Faculté'],
            ['nom' => 'IFRI', 'type' => 'École'],
            ['nom' => 'ENEAM', 'type' => 'École'],
            ['nom' => 'EPAC', 'type' => 'École'],
        ];

        foreach ($etablissements as $data) {
            Etablissement::firstOrCreate(
                ['nom' => $data['nom']],
                ['type' => $data['type']]
            );
        }

        // 2. Récupérer la planification ouverte
        $planification = Planification::where('statut', 'ouverte')->first();
        if (!$planification) {
            $this->command->warn('Aucune planification ouverte trouvée.');
            return;
        }

        // 3. Récupérer les IDs d'établissements
        $etablissement_ids = Etablissement::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            // Générer un matricule unique
            $matricule = 'MAT' . $faker->unique()->numberBetween(10000, 99999);

            // --- 4. Créer BaseUac ---
            $baseUac = BaseUac::create([
                'matricule' => $matricule,
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'email_uac' => $faker->unique()->safeEmail,
            ]);

            // --- 5. Créer VerificationMatricule lié à BaseUac ---
            $verification = VerificationMatricule::create([
                'base_uac_id' => $baseUac->id,
                'matricule' => $baseUac->matricule,
                'email' => $baseUac->email_uac,
                'code_verification' => strtoupper($faker->bothify('CODE###'))
            ]);

            // --- 6. Créer ou récupérer l'étudiant ---
            $etudiant = Etudiant::firstOrCreate(
                ['matricule' => $matricule],
                [
                    'nom' => $faker->lastName,
                    'prenom' => $faker->firstName,
                    'email' => $faker->unique()->safeEmail,
                    'telephone' => '+229' . $faker->numerify('01#######'),
                    'date_naissance' => $faker->date('Y-m-d', '2004-01-01'),
                    'lieu_naissance' => $faker->randomElement(['Cotonou', 'Porto-Novo', 'Abomey-Calavi', 'Parakou', 'Bohicon']),
                    'sexe' => $faker->randomElement(['M', 'F']),
                    'nationalite' => 'Béninoise',
                    'adresse_personnelle' => $faker->randomElement(['Cotonou', 'Porto-Novo', 'Abomey-Calavi', 'Parakou', 'Bohicon']),
                    'handicap' => $faker->boolean(10),
                    'type_handicap' => null,
                    'certificat_handicap' => null,
                ]
            );

            // Si handicap, ajouter type et certificat
            if ($etudiant->handicap) {
                $etudiant->type_handicap = $faker->randomElement(['Moteur', 'Visuel', 'Auditif', 'Mental']);
                $etudiant->certificat_handicap = 'certificats/fake_' . uniqid() . '.pdf';
                $etudiant->save();
            }

            // --- 7. Créer la demande liée à cet étudiant et à la verification ---
            Demande::create([
                'etudiant_matricule' => $etudiant->matricule,
                'verification_matricule_id' => $verification->id,  // Assure-toi que ce champ existe dans ta table demandes
                'planification_id' => $planification->id,
                'etablissement_id' => $faker->randomElement($etablissement_ids),
                'filiere' => $faker->randomElement(['Génie Logiciel', 'Agronomie', 'Economie', 'Anglais', 'Espagnol', 'MIA']),
                'annee_etude' => $faker->randomElement(['1', '2', '3']),
                'fiche_preinscription' => 'fiches/fake_' . uniqid() . '.pdf',
                'code_suivi' => strtoupper(uniqid('REQ')),
                'statut' => 'En cours de traitement',
            ]);
        }

        $this->command->info('✅ 50 demandes créées avec BaseUac, VerificationMatricule et Etudiant.');
    }
}
