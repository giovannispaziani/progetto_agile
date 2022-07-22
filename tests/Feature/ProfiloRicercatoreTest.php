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

    public function test_get_user_not_exists()
    {
        $this->seed();
        $this->assertGuest(); //connessione tramite guest, non fa controlli sull'auth

        $response = $this->get('/users/1000'); //fa visita alla pagina senza il login dell'utente

        $response->assertStatus(200); //si assicura che venga fornita la pagina
        $response->assertSee(["Errore","Utente non trovato"]);

    }

    public function test_get_researcher_profile_user_logged()  // Restituisce il profilo del ricercatore se loggato
    {
        $this->seed();

        $user = User::where('id', 2)->first();

        $response = $this->actingAs($user)->get("/users/".$user->id); //controlla se passa il parametro (id) alla rotta

        $response->assertStatus(200); //si assicura che venga fornita la pagina

    }

    public function test_get_researcher_profile_user_not_logged() // Restituisce il profilo del ricercatore non loggato
    {
        $this->seed();
        $this->assertGuest(); //connessione tramite guest, non fa controlli sull'auth

        $response = $this->get('/users/2'); //fa visita alla pagina senza il login dell'utente

        $response->assertStatus(200); //si assicura che venga fornita correttamente la pagina
        $response->assertSee([  //si assicura che la pagina carichi i dati
            'Ricercatore',
            'Di Prova',
            'Scienze delle Comunicazioni',
            'PR',
            'ricercatore@prova.com',
            '1',
            'Prima pubblicazione 1',
            '1',
            'Prima pubblicazione 2',
            'nasa',
            'nasa.com',
            'unicef',
            'unicef.com',
            'crocerossa',
            'crocerossa.com'
        ]);
    }

    public function test_get_manager_profile_user_logged()  // Restituisce il profilo del manager se loggato
    {
        $this->seed();

        $user = User::where('id', 3)->first();

        $response = $this->actingAs($user)->get("/users/".$user->id); //controlla se passa il parametro (id) alla rotta

        $response->assertStatus(200); //si assicura che venga fornita la pagina

    }

    public function test_get_manager_profile_user_not_logged() // Restituisce il profilo del manager non loggato
    {
        $this->seed();
        $this->assertGuest(); //connessione tramite guest, non fa controlli sull'auth

        $response = $this->get('/users/3'); //fa visita alla pagina senza il login dell'utente

        $response->assertStatus(200); //si assicura che venga fornita correttamente la pagina
        $response->assertSee([  //si assicura che la pagina carichi i dati
            'Manager',
            'Di Prova',
            'Biotecnologie',
            'Ricercatore Biotecnologie',
            'manager@prova.com',
        ]);
    }

    public function test_get_finanziatore_profile_user_logged()  // Restituisce il profilo del finanziatore se loggato
    {
        $this->seed();

        $user = User::where('id', 1)->first();

        $response = $this->actingAs($user)->get("/users/".$user->id); //controlla se passa il parametro (id) alla rotta

        $response->assertStatus(200); //si assicura che venga fornita la pagina

    }

    public function test_get_finanziatore_profile_user_not_logged() // Restituisce il profilo del finanziatore non loggato
    {
        $this->seed();
        $this->assertGuest(); //connessione tramite guest, non fa controlli sull'auth

        $response = $this->get('/users/1'); //fa visita alla pagina senza il login dell'utente

        $response->assertStatus(200); //si assicura che venga fornita correttamente la pagina
        $response->assertSee([  //si assicura che la pagina carichi i dati

            'Admin Admin',
            'Cavasinni',
            'Scienze Politiche',
            'Divulgatore',
            'admin@material.com',

        ]);
    }

}
?>
