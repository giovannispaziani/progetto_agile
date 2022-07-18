<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SottoProgettiTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_get_subprojects_list() {

        $this->seed();

        $user = User::factory()->create([
            'name' => 'Manager',
            'surname' => 'Di Prova',
            'email' => 'manager@prova.com',
            'email_verified_at' => now(),
            'type' => 'Manager',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->actingAs($user)
                        ->get('/sottoProgettiList/1');

        $response->assertStatus(200);
    }

    public function test_subprojects_list_contains_data() {

        $this->seed();

        $user = User::factory()->create([
            'name' => 'Manager',
            'surname' => 'Di Prova',
            'email' => 'manager@prova.com',
            'email_verified_at' => now(),
            'type' => 'Manager',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->actingAs($user)
                        ->get('/sottoProgettiList/1');

        $response->assertStatus(200);
        $response->assertDontSee(["errore","Nessun sottoprogetto"]);
        $response->assertSee([
            'Primo Sottoprogetto',
            'Un sottoprogetto a caso 1',
            '2022-06-15',
            '1'
        ]);
    }

    public function test_subprojects_post()
    {
        $this->seed();

        $user = User::where('id', 3)->first();

        $response = $this->actingAs($user)->post('/aggiungiSottoprogetto',[
                            'responsabile' => 1,
                            'id_progetto' => 1,
                            'titolo' => "Sottoprogetto Test 1",
                            'descrizione' => "Descrizione sottoprogetto Test",
                            'fine' => "2022-06-15"
                         ]);

                         $this->assertDatabaseHas('subprojects', [
                            'titolo' => 'Sottoprogetto Test 1',
                        ]);

        $response->assertStatus(302);

}

}
