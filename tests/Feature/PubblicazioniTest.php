<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class PubblicazioniTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $this->seed();
    }

    public function test_publication_page_get()
    {

        $user = User::where('id', 2)->first();

        $response = $this->actingAs($user)
                         ->get('/aggiungiPubblicazione');

        $response->assertStatus(200);

    }

    public function test_publication_post()
    {

        $user = User::where('id', 2)->first();

        DB::table('pubblications')->where("titolo","Pubblicazione Test")->delete();

        $file = UploadedFile::fake()->create('test.pdf');

        $response = $this->actingAs($user)
                        ->post('/aggiungiPubblicazione',[
                            'file' => $file,
                            'id_progetto' => 1,
                            'titolo' => "Pubblicazione Test",
                            'descrizione' => "Descrizione Test",
                            'testo' => "Test",
                            'file_path' => "uploads/test.pdf"
                         ]);


                         $this->assertDatabaseHas('pubblications',[
                            'titolo' => "Pubblicazione Test",
                        ]);
    }


    public function test_publication_delete_as_author()
    {
        $user = User::where('id', 2)->first();

        $response = $this->actingAs($user)->get('/eliminaPubblicazione/2');

        $response->assertStatus(302);

        $this->assertDatabaseMissing('pubblications',[
            'id' => 2,
        ]);
    }

    public function test_publication_delete_as_unauthorized()
    {
        $user = User::where('id', 5)->first();

        $response = $this->actingAs($user)->get('/eliminaPubblicazione/2');

        $response->assertForbidden();

        $this->assertDatabaseHas('pubblications',[
            'id' => 2,
        ]);
    }

}
