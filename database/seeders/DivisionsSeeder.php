<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('divisions')->insert([
            ['nom' => 'Division de la séparation des données', 'service_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'Division exploitation des systèmes', 'service_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
