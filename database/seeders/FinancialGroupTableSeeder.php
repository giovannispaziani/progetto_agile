<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancialGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('financial_groups')->insert([
            'id_progetto' => 1,
            'id_finanziatore' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('financial_groups')->insert([
            'id_progetto' => 1,
            'id_finanziatore' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('financial_groups')->insert([
            'id_progetto' => 1,
            'id_finanziatore' => 7,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('financial_groups')->insert([
            'id_progetto' => 1,
            'id_finanziatore' => 8,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
