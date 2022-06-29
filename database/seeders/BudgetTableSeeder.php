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
            'id' => 1,
            'id_progetto' => 1,
            'id_ricercatore' => 2,
            'scopo' => 'Materie prime',
            'budget' => 10.00,
            'stato' => 'in attesa',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('budgets')->insert([
            'id' => 2,
            'id_progetto' => 1,
            'id_ricercatore' => 5,
            'scopo' => 'Attrezzature',
            'budget' => 20.22,
            'stato' => 'rifiutato',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('budgets')->insert([
            'id' => 3,
            'id_progetto' => 1,
            'id_ricercatore' => 6,
            'scopo' => 'Pubblicazione',
            'budget' => 33.03,
            'stato' => 'approvato',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}