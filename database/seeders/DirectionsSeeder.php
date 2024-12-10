<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('directions')->insert([
            ['nom' => 'Direction du Système d\'Information et de Communication ', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
