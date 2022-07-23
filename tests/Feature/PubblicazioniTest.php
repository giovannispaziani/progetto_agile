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

    public function test_publication_page_get()
    {

        $this->seed();

        $user = User::where('id', 2)->first();

        $response = $this->actingAs($user)
                         ->get('/aggiungiPubblicazione');

        $response->assertStatus(200);

    }

    public function test_publication_post()
    {

        $this->seed();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

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

}
