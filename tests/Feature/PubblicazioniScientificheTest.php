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

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $this->seed();
    }

    public function test_scientific_publication_page_get()
    {

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

        $user = User::where('id', 2)->first();

        DB::table('scientific_publications')->where("titolo", "Pubblicazione Scientifica Test")->delete();

        $response = $this->actingAs($user)->post('/pubblicazioniScientifiche', [
            'titolo' => "Pubblicazione Scientifica Test",
            'descrizione' => "Descrizione Test",
            'testo' => "Test",
            'fonte' => "Fonte Test"
        ]);

        $this->assertDatabaseHas('scientific_publications', [
            'titolo' => 'Pubblicazione Scientifica Test',
        ]);
    }



    public function test_scientific_publication_delete_as_author()
    {
        $user = User::where('id', 2)->first();

        $response = $this->actingAs($user)->get('/eliminaPubblicazioneScientifica/2');

        $response->assertStatus(302);

        $this->assertDatabaseMissing('scientific_publications',[
            'id' => 2,
        ]);
    }

    public function test_scientific_publication_delete_as_unauthorized()
    {
        $user = User::where('id', 5)->first();

        $response = $this->actingAs($user)->get('/eliminaPubblicazioneScientifica/2');

        $response->assertForbidden();

        $this->assertDatabaseHas('pubblications',[
            'id' => 2,
        ]);
    }

    public function test_scientific_publication_edit_as_author()
    {
        $user = User::where('id', 2)->first();

        $response = $this->actingAs($user)
            ->post('/modificaPubblicazioneScientifica',[
                'id' => 2,
                'titolo' => "ex unicef",
                'descrizione' => "ex pubblicazione unicef",
                'testo' => "ex prima pubblicazione unicef",
                'fonte' => "https://www.unicef.it/missione-e-storia/"
            ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('scientific_publications',[
            'id' => 2,
            'titolo' => "ex unicef",
            'descrizione' => "ex pubblicazione unicef",
            'testo' => "ex prima pubblicazione unicef",
            'fonte' => "https://www.unicef.it/missione-e-storia/"
        ]);
    }

    public function test_scientific_publication_edit_as_unauthorized()
    {
        $user = User::where('id', 5)->first();

        $response = $this->actingAs($user)
            ->post('/modificaPubblicazioneScientifica',[
                'id' => 2,
                'titolo' => "ex unicef",
                'descrizione' => "ex pubblicazione unicef",
                'testo' => "ex prima pubblicazione unicef",
                'fonte' => "https://www.unicef.it/missione-e-storia/"
            ]);

        $response->assertForbidden();

        $this->assertDatabaseMissing('scientific_publications',[
            'id' => 2,
            'titolo' => "ex unicef",
            'descrizione' => "ex pubblicazione unicef",
            'testo' => "ex prima pubblicazione unicef",
            'fonte' => "https://www.unicef.it/missione-e-storia/"
        ]);

        $this->assertDatabaseHas('scientific_publications',[
            'id' => 2,
            'titolo' => "unicef",
            'descrizione' => "pubblicazione unicef",
            'testo' => "prima pubblicazione unicef",
            'fonte' => "https://www.unicef.it/"
        ]);
    }
}
