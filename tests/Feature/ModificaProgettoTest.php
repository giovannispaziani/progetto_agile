<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\assertTrue;

class ModificaProgettoTest extends TestCase
{
    use RefreshDatabase;

    private $authorizedUser;
    private $unauthorizedUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $this->authorizedUser = User::factory()->create([
            'name' => 'authorized',
            'surname' => 'user',
            'email' => 'aaa@aaa.aaa',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make("password1"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $this->unauthorizedUser = User::factory()->create([
            'name' => 'unauthorized',
            'surname' => 'user',
            'email' => 'bbb@bbb.bbb',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make("password2"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('projects')->insert([
            'id' => 7,
            'id_responsabile' => $this->authorizedUser->id,
            'nome' => 'Primo Progetto',
            'descrizione' => 'Un progetto a caso1',
            'data_inizio' => "2022-01-01",
            'data_fine' => "2022-02-02",
            'stato' => 'concluso',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function test_update_ending_date_as_authorized_user()
    {

        $response = $this->actingAs($this->authorizedUser)
                         ->post('/cambio-data-fine-progetto',[
                            'id_progetto' => 7,
                            'fine' => "2023-03-03"
                         ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('projects', [
            'id' => 7,
            'data_fine' => '2023-03-03',
        ]);

        $this->assertDatabaseMissing('projects', [
            'id' => 7,
            'data_fine' => '2022-02-02',
        ]);
    }

    public function test_update_ending_date_as_unauthorized_user()
    {
        
        $response = $this->actingAs($this->unauthorizedUser)
                         ->post('/cambio-data-fine-progetto',[
                            'id_progetto' => 7,
                            'fine' => "2023-03-03"
                         ]);

        $this->assertDatabaseHas('projects', [
            'id' => 7,
            'data_fine' => '2022-02-02',
        ]);

        $this->assertDatabaseMissing('projects', [
            'id' => 7,
            'data_fine' => '2023-03-03',
        ]);
    }
}