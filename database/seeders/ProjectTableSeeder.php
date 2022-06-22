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
            'data_fine' => "2022-12-02",
            'stato' => 'in corso',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'id' => 2,
            'id_responsabile' => 2,
            'nome' => 'Secondo Progetto',
            'descrizione' => 'Un altro progetto a caso',
            'data_inizio' => "2022-04-01",
            'data_fine' => "2022-06-02",
            'stato' => 'concluso',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'id' => 3,
            'id_responsabile' => 3,
            'nome' => 'Terzo Progetto',
            'descrizione' => 'Un terzo progetto a caso',
            'data_inizio' => "2022-02-01",
            'data_fine' => "2022-03-02",
            'stato' => 'cancellato',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
