<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('budgets')->insert([
            'id_progetto' => 1,
            'scopo' => 'Materie prime',
            'budget' => 10.00,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('budgets')->insert([
            'id_progetto' => 1,
            'scopo' => 'Attrezzature',
            'budget' => 20.22,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('budgets')->insert([
            'id_progetto' => 1,
            'scopo' => 'Stipendi',
            'budget' => 33.03,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
