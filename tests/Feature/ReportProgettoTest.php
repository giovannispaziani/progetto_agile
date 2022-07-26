<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class ReportProgettTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $this->seed();
    }

    public function test_report_page_get()
    {

        $user = User::where('id', 2)->first();

        $response = $this->actingAs($user)
            ->get('/aggiungiReport');

        $response->assertStatus(200);

    }

    public function test_report_post()
    {

        $user = User::where('id', 2)->first();

        DB::table('reports')->where("titolo","Report Test")->delete();

        $file = UploadedFile::fake()->create('test.txt');

        $response = $this->actingAs($user)
            ->post('/aggiungiReport',[
                'file' => $file,
                'id_progetto' => 1,
                'titolo' => "Report Test",
                'descrizione' => "Descrizione Test",
                'data' => "2022-07-20"
            ]);


        $this->assertDatabaseHas('reports',[
            'titolo' => "Report Test",
        ]);
    }
   
}
