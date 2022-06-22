<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AggiuntaPartecipanteTest extends TestCase
{
    use RefreshDatabase;

    public function test_aggiunta_partecipante_manager()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $ricercatore = User::factory()->create([
            'name' => 'ricercatore',
            'surname' => 'Ricercatore',
            'email' => 'ricerca@ric.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $manager = User::factory()->create([
            'name' => 'manager',
            'surname' => 'Manager',
            'email' => 'rmanaget@ric.com',
            'email_verified_at' => now(),
            'type' => 'Manager',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $project = Project::factory()->create([
            'nome' => "nomeTest3",
            'descrizione' => "sdvfzdbdfkjfdk",
            'data_inizio' => "2022-01-01",
            'data_fine' => "2024-01-01"
        ]);

        $response = $this->actingAs($manager)
        ->get("/project-dashboard/$project->id/add-ricercatore/$ricercatore->id");

        $response->assertSee("/project-dashboard/$project->id");
    }

    public function test_aggiunta_partecipante_ricercatore(){
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $ricercatore = User::factory()->create([
            'name' => 'ricercatore2',
            'surname' => 'Ricercatore2',
            'email' => 'ricerca2@ric.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $project = Project::factory()->create([
            'nome' => "nomeTest4",
            'descrizione' => "sdvfzdbdfkjfdker",
            'data_inizio' => "2022-01-11",
            'data_fine' => "2023-01-01"
        ]);

        $response = $this->actingAs($ricercatore)
        ->get("/project-dashboard/$project->id/add-ricercatore/$ricercatore->id");
        $response->assertStatus(403);
    }
}
