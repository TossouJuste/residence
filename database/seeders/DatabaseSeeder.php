<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class,]);
        $this->call(CitySeeder::class);
        $this->call(BatimentCabineSeeder::class); 
        $this->call(DemandeSeeder::class);
    }
}
