<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
            'type' => 'Manager',
            'password' => Hash::make('secret'),
            'studi' => 'Scienze Politiche',
            'occupazione' => 'Divulgatore',
            'linkedin' => 'https://it.linkedin.com/in/virna-magagnotti-26107aa1?trk=public_profile_browsemap',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //'Ricercatore','Manager','Finanziatore'

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Ricercatore',
            'surname' => 'Di Prova',
            'email' => 'ricercatore@prova.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'studi' => 'Scienze delle Comunicazioni',
            'occupazione' => 'PR',
            'linkedin' => 'https://it.linkedin.com/in/melania-d-alessandro-7a168b120?trk=public_profile_browsemap',
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
            'studi' => 'Storia Moderna',
            'occupazione' => 'Ricercatore Storia Moderna',
            'linkedin' => 'https://it.linkedin.com/in/veronica-totaro-a9352a71?trk=public_profile_browsemap',
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
            'studi' => 'Giurisprudenza',
            'occupazione' => 'Notaio',
            'linkedin' => 'https://it.linkedin.com/in/marco-meloni-bbb60342?trk=public_profile_browsemap',
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
            'studi' => 'Biotecnologie',
            'occupazione' => 'Ricercatore Biotecnologie',
            'linkedin' => 'https://it.linkedin.com/in/martina-agostinelli-293b4b172?trk=public_profile_browsemap',
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
            'studi' => 'Informatica',
            'occupazione' => 'Sviluppatore Web',
            'linkedin' => 'https://it.linkedin.com/in/andrea-cibelli-ab058319a?trk=people-guest_people_search-card',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 7,
            'name' => 'Finanziatore2',
            'surname' => 'Di Prova2',
            'email' => 'finanziatore2@prova.com',
            'email_verified_at' => now(),
            'type' => 'Finanziatore',
            'password' => Hash::make('secret'),
            'studi' => 'Ingegneria Ambientale',
            'occupazione' => 'Ingegnere',
            'linkedin' => 'https://it.linkedin.com/in/domenico-mori-36587041?trk=public_profile_browsemap',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 8,
            'name' => 'Finanziatore3',
            'surname' => 'Di Prova3',
            'email' => 'finanziatore3@prova.com',
            'email_verified_at' => now(),
            'type' => 'Finanziatore',
            'password' => Hash::make('secret'),
            'studi' => 'Fisica',
            'occupazione' => 'Fisico Nucleare',
            'linkedin' => 'https://it.linkedin.com/in/antorossi',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
