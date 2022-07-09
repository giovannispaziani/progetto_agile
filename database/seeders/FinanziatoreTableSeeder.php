<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FinanziatoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('finanziatore')->insert([
            'id' => 1,
            'id_progetto' => 1,
            'id_finanziatore' => 4,
            'fondo' => '5000'
        ]);

    }
}