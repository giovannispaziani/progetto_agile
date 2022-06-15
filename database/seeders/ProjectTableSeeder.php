<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'id' => 1,
            'id_responsabile' => 1,
            'nome' => 'Primo Progetto',
            'descrizione' => 'Un progetto a caso',
            'data_inizio' => "2022-01-01",
            'data_fine' => "2022-02-02",
            'stato' => 'in corso',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
