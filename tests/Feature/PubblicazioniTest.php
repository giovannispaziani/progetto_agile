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

        $file = UploadedFile::fake()->create('test.bib');

        $response = $this->actingAs($user)
            ->post('/aggiungiPubblicazione',[
                'file' => $file,
                'id_progetto' => 1,
                'titolo' => "Pubblicazione Test",
                'descrizione' => "Descrizione Test",
                'testo' => "Test"
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


    public function test_publication_edit_as_author_with_file_change()
    {
        $user = User::where('id', 2)->first();

        $file = UploadedFile::fake()->create('test.bib');

        $response = $this->actingAs($user)
            ->post('/modificaPubblicazione', [
                'id' => 1,
                'file' => $file,
                'pr_progetto' => 1,
                'titolo' => "Pubblicazione Test",
                'descrizione' => "Descrizione Test",
                'testo' => "Test"
            ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('pubblications', [
            'id' => 1,
            'id_autore' => 2,
            'file_path' => 'test.bib',
            'id_progetto' => 1,
            'titolo' => "Pubblicazione Test",
            'descrizione' => "Descrizione Test",
            'testo' => "Test"
        ]);
    }

    public function test_publication_edit_as_author_without_file_change()
    {
        $user = User::where('id', 2)->first();

        $response = $this->actingAs($user)
            ->post('/modificaPubblicazione', [
                'id' => 1,
                'pr_progetto' => 1,
                'titolo' => "Pubblicazione Test",
                'descrizione' => "Descrizione Test",
                'testo' => "Test"
            ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('pubblications', [
            'id' => 1,
            'id_autore' => 2,
            'file_path' => 'AMM.373-375.130.bib',
            'id_progetto' => 1,
            'titolo' => "Pubblicazione Test",
            'descrizione' => "Descrizione Test",
            'testo' => "Test"
        ]);
    }

    public function test_publication_edit_as_unauthorized()
    {
        $user = User::where('id', 5)->first();

        $file = UploadedFile::fake()->create('test.bib');

        $response = $this->actingAs($user)
            ->post('/modificaPubblicazione', [
                'id' => 1,
                'file' => $file,
                'pr_progetto' => 1,
                'titolo' => "Pubblicazione Test",
                'descrizione' => "Descrizione Test",
                'testo' => "Test"
            ]);

        $response->assertForbidden();

        $this->assertDatabaseMissing('pubblications', [
            'id' => 1,
            'id_autore' => 2,
            'file_path' => 'test.bib',
            'id_progetto' => 1,
            'titolo' => "Pubblicazione Test",
            'descrizione' => "Descrizione Test",
            'testo' => "Test"
        ]);

        $this->assertDatabaseHas('pubblications', [
            'id' => 1,
            'id_progetto' => 1,
            'id_autore' => 2,
            'titolo' => 'Prima pubblicazione 1',
            'descrizione' => 'Prima descrizione 1',
            'testo' => 'Primo testo 1',
            'file_path' => 'AMM.373-375.130.bib'
        ]);
    }
}
