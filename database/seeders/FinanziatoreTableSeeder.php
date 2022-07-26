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
            'id_progetto' => 4,
            'id_finanziatore' => 7,
            'fondo' => '50000',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('finanziatore')->insert([
            'id' => 3,
            'id_progetto' => 7,
            'id_finanziatore' => 8,
            'fondo' => '10000',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
