<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class modificaBudgetTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_modifica_budget()
    {
        $this->seed();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $user = User::factory()->create([
            'name' => 'nondea',
            'surname' => 'Di Prova',
            'email' => 'mcdod@prova.com',
            'email_verified_at' => now(),
            'type' => 'Manager',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response=$this->actingAs($user)->post("/aggiungi-budget",
        [
            "id_progetto"=>1,
            "id_finanziatore"=>1,
            "importo"=>1000
        ]);
        $this->assertDatabaseHas( 'finanziatore',[
            "id_progetto" => 1,
            "id_finanziatore"=>1,
            "fondo"=>1000
        ]);
        
    }
}
