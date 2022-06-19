<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('research_groups')->insert([
            'id_progetto' => 1,
            'id_ricercatore' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('research_groups')->insert([
            'id_progetto' => 1,
            'id_ricercatore' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('research_groups')->insert([
            'id_progetto' => 1,
            'id_ricercatore' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
