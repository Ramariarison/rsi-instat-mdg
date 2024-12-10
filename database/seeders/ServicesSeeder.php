<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->insert([
            ['nom' => 'Service Organisation et Méthodes', 'direction_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Service Etudes et Analyses Informatiques', 'direction_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Service Assistance à l\'Informatisation', 'direction_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Service Exploitation des Systèmes', 'direction_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
