<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PubblicazioniScientificheTest extends TestCase
{

    use RefreshDatabase;

    public function test_scientific_publication_page_get()
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
                         ->get('/pubblicazioniScientifiche');

        $response->assertStatus(200);

    }

    public function test_scientific_publication_post()
    {
        $this->seed();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $user = User::where('id', 2)->first();

        DB::table('scientific_publications')->where("titolo","Pubblicazione Scientifica Test")->delete();

        $response = $this->actingAs($user)->post('/pubblicazioniScientifiche',[
                            'titolo' => "Pubblicazione Scientifica Test",
                            'descrizione' => "Descrizione Test",
                            'testo' => "Test",
                            'fonte' => "Fonte Test"
                         ]);

                         $this->assertDatabaseHas('scientific_publications', [
                            'titolo' => 'Pubblicazione Scientifica Test',
                        ]);

}

}
