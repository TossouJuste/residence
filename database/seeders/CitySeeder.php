<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'nom' => 'BID',
            'nbr_batiment' => 6,
            'description' => 'Cité proche du goudron principal.',
        ]);

        City::create([
           'nom' => 'PIP',
            'nbr_batiment' => 3,
            'description' => 'Cité proche du grand terrain de UAC.',
        ]);

        City::create([
           'nom' => 'CANADIEN',
            'nbr_batiment' => 3,
            'description' => 'Cité proche du grand terrain de BASKET.',
        ]);
    }
}
