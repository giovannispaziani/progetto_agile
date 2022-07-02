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
            'name' => 'Mario',
            'surname' => 'Langi',
            'email' => 'langimario68@gmail.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('Mogol'),
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

        $user = User::factory()->create([
            'name' => 'Mario',
            'surname' => 'Langi',
            'email' => 'langimario68@gmail.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('Mogol'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('scientific_publications')->where("titolo","TitoloTest")->delete();

        $response = $this->actingAs($user)
                         ->post('/pubblicazioneScientifiche',[
                            'titolo' => "TitoloTest",
                            'fonte' => "Fonte Test"
                         ]);

                         $this->assertTrue(!DB::table('scientific_publications')->where("titolo","Titolo Test")->exists(),"Project was created without proper permission (user is not a Manager)");

    }

}
