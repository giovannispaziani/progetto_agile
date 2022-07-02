<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CrazioneProgettoTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_get()
    {
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

        $response = $this->actingAs($user)
                         ->get('/create-project');

        $response->assertStatus(200);
    }

    public function test_post_as_manager()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $user = User::factory()->create([
            'name' => 'Manager',
            'surname' => 'Di Prova',
            'email' => 'manager@prova.com',
            'email_verified_at' => now(),
            'type' => 'Manager',
            'password' => Hash::make('secret'),
            'studi' => 'Informatica',
            'occupazione' => 'Sviluppatore Web',
            'linkedin' => 'https://it.linkedin.com/in/andrea-cibelli-ab058319a?trk=people-guest_people_search-card',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->actingAs($user)
                         ->post('/create-project',[
                            'nome' => "nomeTest",
                            'descrizione' => "descrizioneTest",
                            'inizio' => "2022-01-01",
                            'fine' => "2023-01-01"
                         ]);

        $response->assertSee("Progetto creato con successo");

        $this->assertDatabaseHas('projects', [
            'nome' => 'nomeTest',
        ]);
    }

    public function test_post_as_ricercatore()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $user = User::factory()->create([
            'name' => 'Ricercatore',
            'surname' => 'Di Prova',
            'email' => 'ricercatore@prova.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'studi' => 'Ingegneria Ambientale',
            'occupazione' => 'Ingegnere',
            'linkedin' => 'https://it.linkedin.com/in/domenico-mori-36587041?trk=public_profile_browsemap',
                     'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->actingAs($user)
                         ->post('/create-project',[
                            'nome' => "nomeTest",
                            'descrizione' => "descrizioneTest",
                            'inizio' => "2022-01-01",
                            'fine' => "2023-01-01"
                         ]);

        $response->assertSee("ERRORE DI AUTENTICAZIONE: Utente non autorizzato");

        $this->assertDatabaseMissing('projects', [
            'nome' => 'nomeTest',
        ]);
    }

    public function test_post_as_finanziatore()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $user = User::factory()->create([
            'name' => 'Finanziatore',
            'surname' => 'Di Prova',
            'email' => 'finanziatore@prova.com',
            'email_verified_at' => now(),
            'type' => 'Finanziatore',
            'password' => Hash::make('secret'),
            'studi' => 'Fisica',
            'occupazione' => 'Fisico Nucleare',
            'linkedin' => 'https://it.linkedin.com/in/antorossi',
                     'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->actingAs($user)
                         ->post('/create-project',[
                            'nome' => "nomeTest",
                            'descrizione' => "descrizioneTest",
                            'inizio' => "2022-01-01",
                            'fine' => "2023-01-01"
                         ]);

        $response->assertSee("ERRORE DI AUTENTICAZIONE: Utente non autorizzato");

        $this->assertDatabaseMissing('projects', [
            'nome' => 'nomeTest',
        ]);
    }
}
