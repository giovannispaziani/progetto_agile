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
            'descrizione' => '',
            'testo' => '',
            'fonte' => 'nasa.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('scientific_publications')->insert([
            'id_ricercatore' => 2,
            'titolo' => 'unicef',
            'descrizione' => '',
            'testo' => '',
            'fonte' => 'unicef.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('scientific_publications')->insert([
            'id_ricercatore' => 2,
            'titolo' => 'crocerossa',
            'descrizione' => 'croce',
            'testo' => 'rossa',
            'fonte' => 'crocerossa.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);


    }
}
