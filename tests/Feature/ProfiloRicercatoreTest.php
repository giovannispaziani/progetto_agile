<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Seeder;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfiloRicercatoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_researcher_profile_user_logged()  //restituisce la pagina se l'utente è loggato
    {
        $this->seed();

        $user = User::factory()->create([
            'name' => 'Ricercatore',
            'surname' => 'Di Prova',
            'email' => 'ricercatore@prova.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->actingAs($user)->get("/users/".$user->id); //controlla se passa il parametro (id) alla rotta

        $response->assertStatus(200); //si assicura che venga fornita correttamente la pagina

    }

    public function test_get_not_exists_researcher_profile_user_not_logged()
    {
        $this->seed();
        $this->assertGuest(); //connessione tramite guest, non fa controlli sull'auth

        $response = $this->get('/users/1000'); //fa visita alla pagina senza il login dell'utente

        $response->assertStatus(200); //si assicura che venga fornita correttamente la pagina
        $response->assertSee(["errore","Profilo non trovato"]);

    }

    public function test_get_exists_researcher_profile_user_not_logged()
    {
        $this->seed();
        $this->assertGuest(); //connessione tramite guest, non fa controlli sull'auth

        $response = $this->get('/users/2'); //fa visita alla pagina senza il login dell'utente

        $response->assertStatus(200); //si assicura che venga fornita correttamente la pagina
        $response->assertSee([  //si assicura che la pagina carichi i dati
            '2',
            'Ricercatore',
            'Di Prova',
            'ricercatore@prova.com',
            '1',
            'Prima pubblicazione 1',
            '/storage/test_pdf.pdf',
            '1',
            'Prima pubblicazione 2',
            '/storage/test_pdf.pdf',
           'nasa',
           'nasa.com',
           'unicef',
           'unicef.com',
           'crocerossa',
           'crocerossa.com'
        ]);
    }

}
?>