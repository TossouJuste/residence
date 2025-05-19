<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Batiment;
use App\Models\Cabine;

class BatimentCabineSeeder extends Seeder
{
    public function run(): void
    {
        // Récupération des villes
        $bid = City::where('nom', 'BID')->first();
        $pip = City::where('nom', 'PIP')->first();
        $canadien = City::where('nom', 'CANADIEN')->first();

        // === PIP : Bâtiments E et I ===
        foreach (['E', 'I'] as $batNom) {
            $batiment = Batiment::create([
                'nom' => $batNom,
                'nbr_cabine' => 10,
                'sexe' => $batNom === 'E' ? 'F' : 'M',
                'description' => 'Bâtiment ' . $batNom . ' de la cité PIP',
                'city_id' => $pip->id,
            ]);

            for ($i = 1; $i <= 5; $i++) {
                Cabine::create([
                    'code' => $batNom . $i . 'à 2',
                    'batiment_id' => $batiment->id,
                    'places_initiales' => 2,
                    'places_disponibles' => 2,
                ]);
                Cabine::create([
                    'code' => $batNom . $i . 'à 3',
                    'batiment_id' => $batiment->id,
                    'places_initiales' => 3,
                    'places_disponibles' => 3,
                ]);
            }
        }

        // === CANADIEN : Bâtiments G et H ===
        foreach (['G', 'H'] as $batNom) {
            $batiment = Batiment::create([
                'nom' => $batNom,
                'nbr_cabine' => 7,
                'sexe' => 'M',
                'description' => 'Bâtiment ' . $batNom . ' de la cité CANADIEN',
                'city_id' => $canadien->id,
            ]);

            for ($i = 1; $i <= 7; $i++) {
                Cabine::create([
                    'code' => $batNom . $i,
                    'batiment_id' => $batiment->id,
                    'places_initiales' => 4,
                    'places_disponibles' => 4,
                ]);
            }
        }

        // === PIP : Bâtiment D (féminin), C et F (masculins) ===
        foreach ([
            ['nom' => 'C', 'sexe' => 'M'],
            ['nom' => 'D', 'sexe' => 'F'],
            ['nom' => 'F', 'sexe' => 'M'],
        ] as $batData) {
            $batiment = Batiment::create([
                'nom' => $batData['nom'],
                'nbr_cabine' => 8, // Nombre total des codes générés
                'sexe' => $batData['sexe'],
                'description' => 'Bâtiment ' . $batData['nom'] . ' de la cité BID',
                'city_id' => $bid->id,
            ]);

            for ($etage = 0; $etage <= 3; $etage++) {
                for ($num = 1; $num <= 2; $num++) {
                    $code = $batData['nom'] . $etage . '-0' . $num;
                    Cabine::create([
                        'code' => $code,
                        'batiment_id' => $batiment->id,
                        'places_initiales' => 2,
                        'places_disponibles' => 2,
                    ]);
                }
                // Pour le 3ème étage on ajoute une 3e cabine (02 et 03)
                if ($etage === 3) {
                    $code = $batData['nom'] . '3-03';
                    Cabine::create([
                        'code' => $code,
                        'batiment_id' => $batiment->id,
                        'places_initiales' => 2,
                        'places_disponibles' => 2,
                    ]);
                }
            }
        }
    }
}
