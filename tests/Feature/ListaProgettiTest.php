<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ListaProgettiTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_get()
    {
        $response = $this->get('/project-list');

        $response->assertStatus(200);
    }

    public function test_page_get_empty()
    {
        $response = $this->get('/project-list');

        $response->assertStatus(200);

        $response->assertSee("Nessun progetto trovato");
    }

    public function test_page_get_data()
    {
        //aggiungi menager da usare come responsabile
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'cccc',
            'surname' => 'dddd',
            'email' => 'ccc@ccc.ccc',
            'email_verified_at' => now(),
            'type' => 'Manager',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //aggiungi menager da usare come responsabile
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'aaaa',
            'surname' => 'bbbb',
            'email' => 'aaa@aaa.aaa',
            'email_verified_at' => now(),
            'type' => 'Manager',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('projects')->insert([
            'id_responsabile' => 2,
            'nome' => 'Primo Progetto',
            'descrizione' => 'Un progetto a caso1',
            'data_inizio' => "2022-01-01",
            'data_fine' => "2022-02-02",
            'stato' => 'concluso',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'id_responsabile' => 2,
            'nome' => 'Secondo Progetto',
            'descrizione' => 'Un progetto a caso2',
            'data_inizio' => "2022-01-03",
            'data_fine' => "2022-02-04",
            'stato' => 'in corso',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->insert([
            'id_responsabile' => 1,
            'nome' => 'Terzo Progetto',
            'descrizione' => 'Un progetto a caso3',
            'data_inizio' => "2022-01-05",
            'data_fine' => "2022-02-06",
            'stato' => 'cancellato',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->get('/project-list');

        $response->assertStatus(200);

        $response->assertSee([
            "Primo Progetto",
            "Secondo Progetto",
            "Terzo Progetto",
            "Un progetto a caso1",
            "Un progetto a caso2",
            "Un progetto a caso3",
            "2022-01-01",
            "2022-02-02",
            "2022-01-03",
            "2022-02-04",
            "2022-01-05",
            "2022-02-06",
            "concluso",
            "in corso",
            "cancellato",
            "cccc dddd",
            "aaaa bbbb"
        ]);
    }

}