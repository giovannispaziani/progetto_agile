<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->insert([
            'id' => 1,
            'id_progetto' => 1,
            'id_ricercatore' => 2,
            'titolo' => 'Report Progetto 1',
            'descrizione' => 'Descrizione Report 1',
            'data' => '2022-07-15',
            'file_path' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('reports')->insert([
            'id' => 2,
            'id_progetto' => 2,
            'id_ricercatore' => 2,
            'titolo' => 'Report Progetto 2',
            'descrizione' => 'Descrizione Report 2',
            'data' => '2022-06-30',
            'file_path' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('reports')->insert([
            'id' => 3,
            'id_progetto' => 3,
            'id_ricercatore' => 2,
            'titolo' => 'Report Progetto 3',
            'descrizione' => 'Descrizione Report 3',
            'data' => '2022-07-01',
            'file_path' => '',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
