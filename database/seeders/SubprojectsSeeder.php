<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubprojectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subprojects')->insert([
            'id' => 1,
            'id_responsabile' => 1,
            'id_progetto' => 1,
            'titolo' => 'Primo Sottoprogetto',
            'descrizione' => 'Un sottoprogetto a caso 1',
            'data_fine' => "2022-06-15",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('subprojects')->insert([
            'id' => 2,
            'id_responsabile' => 2,
            'id_progetto' => 2,
            'titolo' => 'Secondo Sottoprogetto',
            'descrizione' => 'Un sottoprogetto a caso 2',
            'data_fine' => "2022-07-25",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('subprojects')->insert([
            'id' => 3,
            'id_responsabile' => 1,
            'id_progetto' => 3,
            'titolo' => 'Terzo sottoprogetto',
            'descrizione' => 'Un sottoprogetto a caso 3',
            'data_fine' => "2022-07-29",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
