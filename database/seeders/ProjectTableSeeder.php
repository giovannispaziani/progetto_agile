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

        DB::table('projects')->insert([
            'id' => 2,
            'id_responsabile' => 2,
            'nome' => 'Secondo Progetto',
            'descrizione' => 'Un secondo progetto a caso',
            'data_inizio' => "2022-01-01",
            'data_fine' => "2022-02-02",
            'stato' => 'concluso',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'id' => 3,
            'id_responsabile' => 1,
            'nome' => 'Terzo Progetto',
            'descrizione' => 'Un terzo progetto a caso',
            'data_inizio' => "2022-01-01",
            'data_fine' => "2022-02-02",
            'stato' => 'cancellato',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'id' => 4,
            'id_responsabile' => 1,
            'nome' => 'Quarto Progetto',
            'descrizione' => 'Un quarto progetto a caso',
            'data_inizio' => "2022-01-01",
            'data_fine' => "2022-09-02",
            'stato' => 'in corso',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'id' => 5,
            'id_responsabile' => 1,
            'nome' => 'Quinto Progetto',
            'descrizione' => 'Un quinto progetto a caso',
            'data_inizio' => "2022-01-01",
            'data_fine' => "2022-01-20",
            'stato' => 'concluso',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'id' => 6,
            'id_responsabile' => 1,
            'nome' => 'Sesto Progetto',
            'descrizione' => 'Un sesto progetto a caso',
            'data_inizio' => "2022-01-01",
            'data_fine' => "2022-04-02",
            'stato' => 'cancellato',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'id' => 7,
            'id_responsabile' => 1,
            'nome' => 'Settimo Progetto',
            'descrizione' => 'Un settimo progetto a caso',
            'data_inizio' => "2022-01-09",
            'data_fine' => "2022-12-02",
            'stato' => 'in corso',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'id' => 8,
            'id_responsabile' => 1,
            'nome' => 'Ottavo Progetto',
            'descrizione' => 'Un ottavo progetto a caso',
            'data_inizio' => "2022-01-03",
            'data_fine' => "2022-02-20",
            'stato' => 'concluso',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'id' => 9,
            'id_responsabile' => 1,
            'nome' => 'Nono Progetto',
            'descrizione' => 'Un nono progetto a caso',
            'data_inizio' => "2022-01-01",
            'data_fine' => "2022-05-03",
            'stato' => 'cancellato',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        
    }
}
