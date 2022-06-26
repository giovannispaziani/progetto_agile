<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Hash;

class DocumentationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_view_page()
    {
        $this->seed();
        $user=
        $response = $this->get('/project-dashboard/document-list/1');

        $response->assertStatus(302);
    }
    public function  test_manager_view_page()
    {
        $this->seed();
        $user = User::factory()->create([
            'name' => 'Manager',
            'surname' => 'Di Prova',
            'email' => 'manager@prova.com',
            'email_verified_at' => now(),
            'type' => 'Manager',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $project = Project::factory()->create([
            'nome' => "nomeTest",
            'descrizione' => "descrizioneTest",
            'data_inizio' => "2022-01-01",
            'data_fine' => "2023-01-01"
        ]);

        $response = $this->actingAs($user)->get('/project-dashboard/document-list/'.$project->id);
        $response->assertStatus(200);
    }
}
