<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MilestoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('milestones')->insert([
            'id' => 1,
            'id_sottoprogetto' => 1,
            'data' => "2022-06-15",
            'titolo' => 'Prima Milestone',
            'descrizione' => 'Milestone 1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('milestones')->insert([
            'id' => 2,
            'id_sottoprogetto' => 1,
            'data' => "2022-07-15",
            'titolo' => 'Seconda Milestone',
            'descrizione' => 'Milestone 2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('milestones')->insert([
            'id' => 3,
            'id_sottoprogetto' => 1,
            'data' => "2022-08-15",
            'titolo' => 'Terza Milestone',
            'descrizione' => 'Milestone 3',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
