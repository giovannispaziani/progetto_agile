<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ScientificPublicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scientific_publications')->insert([
            'id_ricercatore' => 2,
            'titolo' => 'nasa',
            'descrizione' => 'pubblicazione nasa',
            'testo' => 'prima pubblicazione nasa',
            'fonte' => 'https://www.nasa.gov/',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('scientific_publications')->insert([
            'id_ricercatore' => 2,
            'titolo' => 'unicef',
            'descrizione' => 'pubblicazione unicef',
            'testo' => 'prima pubblicazione unicef',
            'fonte' => 'https://www.unicef.it/',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('scientific_publications')->insert([
            'id_ricercatore' => 2,
            'titolo' => 'crocerossa',
            'descrizione' => 'pubblicazione crocerossa',
            'testo' => 'prima pubblicazione crocerossa',
            'fonte' => 'https://cri.it/',
            'created_at' => now(),
            'updated_at' => now()
        ]);


    }
}
