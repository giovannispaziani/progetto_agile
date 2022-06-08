<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publication')->insert([
            '' =
            'titolo' => 'Covid 19 Report 2020',
            'fonte' => 'www.iss.it',
        ]);
    }
}
