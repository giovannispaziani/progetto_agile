<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PubblicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pubblications')->insert([
            'id' => 1,
            'id_progetto' => 1,
            'id_autore' => 2,
            'titolo' => 'Prima pubblicazione 1',
            'descrizione' => 'Prima descrizione 1',
            'testo' => 'Primo testo 1',
            'file_path' => 'AMM.373-375.130.bib',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('pubblications')->insert([
            'id' => 2,
            'id_progetto' => 1,
            'id_autore' => 2,
            'titolo' => 'Prima pubblicazione 2',
            'descrizione' => 'Prima',
            'testo' => 'Pub 2',
            'file_path' => 'AMM.373-375.130.bib',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('pubblications')->insert([
            'id' => 3,
            'id_progetto' => 1,
            'id_autore' => 5,
            'titolo' => 'Prima pubblicazione 3',
            'descrizione' => '',
            'testo' => '',
            'file_path' => 'AMM.373-375.130.bib',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
