<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Budget;
use Illuminate\Support\Facades\Hash;
class storicoBudgetTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_not_responsabile_view()
    {
        $this->seed();

        $user=User::factory()->create([
            'name' => 'nome',
            'surname' => 'Di Prova',
            'email' => 'nome.diProva@prova.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->actingAs($user)->get('/storico-budget/1');

        $response->assertStatus(403);
    }

    public function test_responsabile_view()
    {
        $this->seed();

        $user=User::where("id",1)->first();

        $response = $this->actingAs($user)->get('/storico-budget/1');

        $response->assertStatus(200);
    }
}
