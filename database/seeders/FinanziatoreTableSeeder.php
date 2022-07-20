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
            'fondo' => '5000',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('finanziatore')->insert([
            'id' => 2,
            'id_progetto' => 2,
            'id_finanziatore' => 7,
            'fondo' => '7000',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('finanziatore')->insert([
            'id' => 3,
            'id_progetto' => 3,
            'id_finanziatore' => 8,
            'fondo' => '9000',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}