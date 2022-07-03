<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class BudgetRicercatoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_budget_list_ricercatore_page_get()
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

        $response = $this->actingAs($user)
                         ->get('/budgetRicercatore');

        $response->assertStatus(200);

    }

    public function test_aggiungi_voce_page_get()
    {
        $this->seed();

        $user = User::where('id', 2)->first();

        $response = $this->actingAs($user)
                         ->get('/aggiungiVoce');

        $response->assertStatus(200);

    }

    public function test_get_voci_spesa_ricercatore()
    {
        $this->seed();
        $this->assertGuest(); //connessione tramite guest, non fa controlli sull'auth

        $user = User::where('id', 2)->first();

        $response = $this->actingAs($user)
                         ->get('/budgetRicercatore');

        $response->assertStatus(200); //si assicura che venga fornita correttamente la pagina
        $response->assertSee([  //si assicura che la pagina carichi i dati
            '1',
            'Materiali',
            '1000.00'
        ]);
    }

    public function test_voci_spesa_post()
    {
        $this->withoutExceptionHandling();
        $this->seed();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $user = User::where('id', 2)->first();

        $response = $this->actingAs($user)
                        ->post('/aggiungiVoce',[
                            'check-progetto' => 1,
                            'check-scopo' => "Pubblicazione",
                            'budget' => "30.00",
                            'stato' => "in attesa"
                         ]);

        $response->assertSee("Voce spesa aggiunta");

                         $this->assertDatabaseHas('budgets',[
                            'id_progetto' => 1,
                            'scopo' => "Pubblicazione",
                            'budget' => "30.00",
                            'stato' => "in attesa"
                        ]);
    }

}
