<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubprojectsResearchersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('ricercatori_sottoprogetti')->insert([
            'id_sottoprogetto' => 1,
            'id_ricercatore' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('ricercatori_sottoprogetti')->insert([
            'id_sottoprogetto' => 2,
            'id_ricercatore' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('ricercatori_sottoprogetti')->insert([
            'id_sottoprogetto' => 3,
            'id_ricercatore' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
