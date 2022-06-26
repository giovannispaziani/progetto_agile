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

        
        /////////////  NON CANCELLARE
        DB::table('research_groups')->insert([
            'id_progetto' => 1,
            'id_ricercatore' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        /////////////  NON CANCELLARE

        /////////////  NON CANCELLARE
        DB::table('research_groups')->insert([
            'id_progetto' => 1,
            'id_ricercatore' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        /////////////  NON CANCELLARE

        /////////////  NON CANCELLARE
        DB::table('research_groups')->insert([
            'id_progetto' => 1,
            'id_ricercatore' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        /////////////  NON CANCELLARE


        DB::table('research_groups')->insert([
            'id_progetto' => 2,
            'id_ricercatore' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('research_groups')->insert([
            'id_progetto' => 3,
            'id_ricercatore' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('research_groups')->insert([
            'id_progetto' => 4,
            'id_ricercatore' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('research_groups')->insert([
            'id_progetto' => 5,
            'id_ricercatore' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('research_groups')->insert([
            'id_progetto' => 6,
            'id_ricercatore' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('research_groups')->insert([
            'id_progetto' => 7,
            'id_ricercatore' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('research_groups')->insert([
            'id_progetto' => 8,
            'id_ricercatore' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('research_groups')->insert([
            'id_progetto' => 9,
            'id_ricercatore' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
