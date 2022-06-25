<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProjectDashboardTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin Admin',
            'surname' => 'Cavasinni',
            'email' => 'admin@material.com',
            'email_verified_at' => now(),
            'type' => 'Finanziatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Ricercatore',
            'surname' => 'Di Prova',
            'email' => 'ricercatore@prova.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 5,
            'name' => 'Ricercatore2',
            'surname' => 'Di Prova2',
            'email' => 'ricercatore@prova2.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 6,
            'name' => 'Ricercatore3',
            'surname' => 'Di Prova3',
            'email' => 'ricercatore@prova3.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Manager',
            'surname' => 'Di Prova',
            'email' => 'manager@prova.com',
            'email_verified_at' => now(),
            'type' => 'Manager',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Finanziatore',
            'surname' => 'Di Prova',
            'email' => 'finanziatore@prova.com',
            'email_verified_at' => now(),
            'type' => 'Finanziatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 7,
            'name' => 'Finanziatore2',
            'surname' => 'Di Prova2',
            'email' => 'finanziatore@prova.com',
            'email_verified_at' => now(),
            'type' => 'Finanziatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 8,
            'name' => 'Finanziatore3',
            'surname' => 'Di Prova3',
            'email' => 'finanziatore@prova.com',
            'email_verified_at' => now(),
            'type' => 'Finanziatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'id' => 1,
            'id_responsabile' => 1,
            'nome' => 'Primo Progetto',
            'descrizione' => 'Un progetto a caso',
            'data_inizio' => "2022-01-01",
            'data_fine' => "2022-02-02",
            'stato' => 'in corso',
            'created_at' => now(),
            'updated_at' => now()
        ]);

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

        DB::table('research_groups')->insert([
            'id_progetto' => 1,
            'id_ricercatore' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('research_groups')->insert([
            'id_progetto' => 1,
            'id_ricercatore' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('research_groups')->insert([
            'id_progetto' => 1,
            'id_ricercatore' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('pubblications')->insert([
            'id' => 1,
            'id_progetto' => 1,
            'id_autore' => 2,
            'titolo' => 'Prima pubblicazione 1',
            'file_path' => '/storage/test_pdf.pdf',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('pubblications')->insert([
            'id' => 2,
            'id_progetto' => 1,
            'id_autore' => 2,
            'titolo' => 'Prima pubblicazione 2',
            'file_path' => '/storage/test_pdf.pdf',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('pubblications')->insert([
            'id' => 3,
            'id_progetto' => 1,
            'id_autore' => 5,
            'titolo' => 'Prima pubblicazione 3',
            'file_path' => '/storage/test_pdf.pdf',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('budgets')->insert([
            'id' => 1,
            'id_progetto' => 1,
            'scopo' => 'Materie prime',
            'budget' => 10.00,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('budgets')->insert([
            'id' => 2,
            'id_progetto' => 1,
            'scopo' => 'Attrezzature',
            'budget' => 20.22,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('budgets')->insert([
            'id' => 3,
            'id_progetto' => 1,
            'scopo' => 'Stipendi',
            'budget' => 33.03,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}