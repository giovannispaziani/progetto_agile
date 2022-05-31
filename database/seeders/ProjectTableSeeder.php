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
            'id_responsabile' => 1,
            'nome' => 'Primo Progetto',
            'descrizione' => 'Un progetto a caso',
            'data_inizio' => now(),
            'data_fine' => now(),
            'stato' => 'in corso',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
