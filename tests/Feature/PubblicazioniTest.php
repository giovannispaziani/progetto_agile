<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PubblicazioniTest extends TestCase
{

    use RefreshDatabase;

    public function test_publication_page_get()
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
                         ->get('/aggiungiPubblicazione');

        $response->assertStatus(200);

    }

    public function test_publication_post()
    {
        $this->withoutExceptionHandling();
        $this->seed();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $user = User::where('id', 2)->first();

        DB::table('pubblications')->where("titolo","Pubblicazione Test")->delete();

        $response = $this->actingAs($user)
                        ->post('/aggiungiPubblicazione',[
                            'id_progetto' => "1",
                            'titolo' => "Pubblicazione Test",
                            'file_path' => "test_pdf.pdf"
                         ]);

        $response->assertSee("Pubblicazione aggiunta");

                         $this->assertDatabaseHas('pubblications',[
                            'titolo' => "Pubblicazione Test",
                        ]);
    }

}