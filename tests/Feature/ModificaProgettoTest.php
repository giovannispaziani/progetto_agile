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

    private $authorizedUserResponsabile;
    private $authorizedUserManager;
    private $unauthorizedUser;
    private $newResponsabile;
    private $edit;
    private $expectedEdit;
    private $projectData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $this->authorizedUserResponsabile = User::factory()->create([
            'name' => 'authorized',
            'surname' => 'user',
            'email' => 'aaa@aaa.aaa',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make("password1"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $this->authorizedUserManager = User::factory()->create([
            'name' => 'authorized',
            'surname' => 'manager',
            'email' => 'mmm@mmm.mmm',
            'email_verified_at' => now(),
            'type' => 'Manager',
            'password' => Hash::make("password3"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $this->newResponsabile = User::factory()->create([
            'name' => 'new',
            'surname' => 'responsabile',
            'email' => 'nnn@nnn.nnn',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make("password4"),
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
        $this->projectData = [
            'id' => 7,
            'id_responsabile' => $this->authorizedUserResponsabile->id,
            'nome' => 'Primo Progetto',
            'descrizione' => 'Un progetto a caso1',
            'data_inizio' => "2022-01-01",
            'data_fine' => "2022-02-02",
            'stato' => 'concluso'
        ];
        DB::table('projects')->insert($this->projectData);

        $this->edit = [
            'id_progetto' => 7,
            'nome' => "editNome",
            'descrizione' => "editDescrizione",
            'inizio' => "2030-01-01",
            'fine' => "2033-02-02",
            'stato' => "concluso",
            'resbonsabile' => $this->newResponsabile->id
        ];
        $this->expectedEdit = [
            'id' => 7,
            'nome' => "editNome",
            'descrizione' => "editDescrizione",
            'data_inizio' => "2030-01-01",
            'data_fine' => "2033-02-02",
            'stato' => "concluso",
            'id_responsabile' => $this->newResponsabile->id
        ];
    }

    public function test_update_ending_date_as_authorized_user()
    {

        $response = $this->actingAs($this->authorizedUserResponsabile)
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
        
        $this->actingAs($this->unauthorizedUser)
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

    public function test_delete_as_authorized_user()
    {
        $getResponse = $this->actingAs($this->authorizedUserManager)->get('/project-dashboard/7');
        $getResponse->assertStatus(200);
        $getResponse->assertSee("Elimina");

        $response = $this->actingAs($this->authorizedUserManager)
                         ->post('/elimina-progetto',[
                            'id_progetto' => 7
                         ]);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('projects', [
            'id' => 7
        ]);
    }

    public function test_delete_as_unauthorized_responsabile()
    {
        // Solo i manager possono eliminare i progetti, quindi mi assicuro che anche il responsabile
        // non ha i permessi per eliminare il progetto

        $getResponse = $this->actingAs($this->authorizedUserResponsabile)->get('/project-dashboard/7');
        $getResponse->assertStatus(200);
        $getResponse->assertDontSee("Elimina");

        $response = $this->actingAs($this->authorizedUserResponsabile)
                         ->post('/elimina-progetto',[
                            'id_progetto' => 7
                         ]);

        $response->assertStatus(200);
        $response->assertSee("ERRORE");

        $this->assertDatabaseHas('projects', [
            'id' => 7
        ]);
    }

    public function test_delete_as_unauthorized_user()
    {
        $getResponse = $this->actingAs($this->unauthorizedUser)->get('/project-dashboard/7');
        $getResponse->assertStatus(200);
        $getResponse->assertDontSee("Elimina");

        $response = $this->actingAs($this->unauthorizedUser)
                         ->post('/elimina-progetto',[
                            'id_progetto' => 7
                         ]);

        $response->assertStatus(200);
        $response->assertSee("ERRORE");
                 

        $this->assertDatabaseHas('projects', [
            'id' => 7
        ]);
    }

    public function test_edit_as_authorized_user()
    {
        $getResponse = $this->actingAs($this->authorizedUserManager)->get('/project-dashboard/7');
        $getResponse->assertStatus(200);
        $getResponse->assertSee("Modifica progetto");

        $response = $this->actingAs($this->authorizedUserManager)->post('/modifica-progetto',$this->edit);

        $response->assertStatus(302);

        $this->assertDatabaseHas('projects', $this->expectedEdit);
        $this->assertDatabaseMissing('projects', $this->projectData);
    }

    public function test_edit_as_unauthorized_responsabile()
    {
        // Solo i manager possono eliminare i progetti, quindi mi assicuro che anche il responsabile
        // non ha i permessi per eliminare il progetto

        $getResponse = $this->actingAs($this->authorizedUserResponsabile)->get('/project-dashboard/7');
        $getResponse->assertStatus(200);
        $getResponse->assertDontSee("Modifica progetto");

        $response = $this->actingAs($this->authorizedUserResponsabile)->post('/modifica-progetto',$this->edit);

        $response->assertStatus(200);
        $response->assertSee("ERRORE");

        $this->assertDatabaseMissing('projects', $this->expectedEdit);
        $this->assertDatabaseHas('projects', $this->projectData);
    }

    public function test_edit_as_unauthorized_user()
    {
        $getResponse = $this->actingAs($this->unauthorizedUser)->get('/project-dashboard/7');
        $getResponse->assertStatus(200);
        $getResponse->assertDontSee("Modifica progetto");

        $response = $this->actingAs($this->unauthorizedUser)->post('/modifica-progetto',$this->edit);

        $response->assertStatus(200);
        $response->assertSee("ERRORE");

        $this->assertDatabaseMissing('projects', $this->expectedEdit);
        $this->assertDatabaseHas('projects', $this->projectData);
    }
}