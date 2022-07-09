<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class BudgetFinanziatoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_financier_dashboard_page()  //restituisce la pagina se l'utente è loggato
    {
        $this->seed();

        $user = User::factory()->create([
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

        $response = $this->actingAs($user)->get("/dashboardFinanziatore");

        $response->assertStatus(200); //si assicura che venga fornita la pagina

    }

    public function test_budget_financier_page_get()
    {
        $this->seed();

        $user=User::where("id",4)->first();

        $response = $this->actingAs($user)
                         ->get('/budgetFinanziatore/1');

        $response->assertStatus(200); //si assicura che venga fornita la pagina

    }

    public function test_get_lista_richieste_budget_progetto_finanziato()
    {
        $this->seed();
        $this->assertGuest(); //connessione tramite guest, non fa controlli sull'auth

        $user = User::where('id', 4)->first();

        $response = $this->actingAs($user)
                         ->get('/budgetFinanziatore/1');

        $response->assertStatus(200); //si assicura che venga fornita la pagina
        $response->assertSee([  //si assicura che la pagina carichi i dati
            '1',
            'Materiali',
            '1000.00'
        ]);
    }

}