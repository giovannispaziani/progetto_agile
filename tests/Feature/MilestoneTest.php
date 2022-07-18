<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MilestoneTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_get_milestone_list() {

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

        $response = $this->actingAs($user)
                        ->get('/milestoneList/1');

        $response->assertStatus(200);
    }

    public function test_milestone_list_contains_data() {

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

        $response = $this->actingAs($user)
                        ->get('/milestoneList/1');

        $response->assertStatus(200);
        $response->assertDontSee(["errore","Nessuna milestone.."]);
        $response->assertSee([
            'Prima Milestone',
            'Milestone 1',
            '2022-06-15'
        ]);
    }

    public function test_milestone_post()
    {
        $this->seed();

        $user = User::where('id', 3)->first();

        $response = $this->actingAs($user)->post('/aggiungiMilestone',[
                            'id_sottoprogetto' => 1,
                            'titolo' => "Milestone Test 1",
                            'descrizione' => "Descrizione milestone Test",
                            'data' => "2022-07-14"
                         ]);

                         $this->assertDatabaseHas('milestones', [
                            'titolo' => 'Milestone Test 1',
                        ]);

        $response->assertStatus(302);

}

}
