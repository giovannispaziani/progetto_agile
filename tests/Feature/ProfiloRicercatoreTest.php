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

        $user = User::factory()->create([
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

    public function test_get_manager_profile_user_logged()  // Restituisce il profilo del manager se loggato
    {
        $this->seed();

        $user = User::factory()->create([
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

        $user = User::factory()->create([
            'name' => 'Admin Admin',
            'surname' => 'Cavasinni',
            'email' => 'admin@material.com',
            'email_verified_at' => now(),
            'type' => 'Finanziatore',
            'password' => Hash::make('secret'),
            'studi' => 'Scienze Politiche',
            'occupazione' => 'Divulgatore',
            'linkedin' => 'https://it.linkedin.com/in/virna-magagnotti-26107aa1?trk=public_profile_browsemap',
            'created_at' => now(),
            'updated_at' => now()
        ]);

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
