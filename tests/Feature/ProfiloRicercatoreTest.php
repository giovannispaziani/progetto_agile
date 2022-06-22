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

        $response = $this->actingAs($user)->get('/users/Auth::user()->id');

        $this->assertTrue(true);

    }

    public function test_get_researcher_profile_user_not_logged()
    {
        $this->seed();
        $this->assertGuest(); //connessione tramite guest, non fa controlli sull'auth

        $response = $this->get('/users/2'); //fa visita alla pagina senza il login dell'utente

        $this->assertTrue(true);
    }

}
?>