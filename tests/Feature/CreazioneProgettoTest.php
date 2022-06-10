<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CrazioneProgettoTest extends TestCase
{
    public function test_page_get()
    {
        $user = User::factory()->make();

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
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->where("nome","nomeTest")->delete();

        $response = $this->actingAs($user)
                         ->post('/create-project',[
                            'nome' => "nomeTest",
                            'descrizione' => "descrizioneTest",
                            'inizio' => "2022-01-01",
                            'fine' => "2023-01-01"
                         ]);
        
        $response->assertSee("Progetto creato con successo");

        $this->assertTrue(DB::table('projects')->where("nome","nomeTest")->exists(),"Project was created");

        DB::table('projects')->where("nome","nomeTest")->delete();
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
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->where("nome","nomeTest")->delete();

        $response = $this->actingAs($user)
                         ->post('/create-project',[
                            'nome' => "nomeTest",
                            'descrizione' => "descrizioneTest",
                            'inizio' => "2022-01-01",
                            'fine' => "2023-01-01"
                         ]);
        
        $response->assertSee("ERRORE DI AUTENTICAZIONE: Utente non autorizzato");

        $this->assertTrue(!DB::table('projects')->where("nome","nomeTest")->exists(),"Project was created without proper permission (user is not a Manager)");
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
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->where("nome","nomeTest")->delete();

        $response = $this->actingAs($user)
                         ->post('/create-project',[
                            'nome' => "nomeTest",
                            'descrizione' => "descrizioneTest",
                            'inizio' => "2022-01-01",
                            'fine' => "2023-01-01"
                         ]);
        
        $response->assertSee("ERRORE DI AUTENTICAZIONE: Utente non autorizzato");

        $this->assertTrue(!DB::table('projects')->where("nome","nomeTest")->exists(),"Project was created without proper permission (user is not a Finanziatore)");
    }
}