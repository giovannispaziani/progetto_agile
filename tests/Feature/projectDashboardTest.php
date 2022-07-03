<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\ProjectDashboardTestSeeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class projectDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $this->seed(ProjectDashboardTestSeeder::class);
    }

    public function test_page_as_guest()
    {

        $this->assertGuest();

        $response = $this->get('/project-dashboard/1');

        $response->assertStatus(200);
    }

    public function test_page_not_found_as_guest()
    {
        $this->assertGuest();

        $response = $this->get('/project-dashboard/4');

        $response->assertStatus(200);
    }

    public function test_page_as_auth()
    {

        $user = User::factory()->create([
            'name' => 'Ricercatore',
            'surname' => 'Di Prova',
            'email' => 'ricercatore@prova.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->actingAs($user)
                         ->get('/project-dashboard/1');

        $response->assertStatus(200);
    }

    public function test_page_not_found_as_auth()
    {

        $user = User::factory()->create([
            'name' => 'Ricercatore',
            'surname' => 'Di Prova',
            'email' => 'ricercatore@prova.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->actingAs($user)
                         ->get('/project-dashboard/4');

        $response->assertStatus(200);
    }

    public function test_page_as_manager()
    {

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
                        ->get('/project-dashboard/1');

        $response->assertStatus(200);
    }

    public function test_page_not_found_as_manager()
    {

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
                        ->get('/project-dashboard/4');

        $response->assertStatus(200);
    }

    public function test_page_contains_data()
    {
        $this->assertGuest();

        $response = $this->get('/project-dashboard/1');

        $response->assertStatus(200);
        $response->assertDontSee(["errore","Progetto non trovato"]);
        $response->assertSee([
            'Primo Progetto',
            'Un progetto a caso',
            'Admin Admin',
            '../users/1',
            '../users/4',
            '../users/7',
            '../users/8',
            '../users/2',
            '../users/5',
            '../users/6',
            '../budgets/1',
            '../budgets/2',
            '../budgets/3',
            '../pubblicazioni/1',
            '../pubblicazioni/2',
            '../pubblicazioni/3',
            'Prima pubblicazione 1',
            'Prima pubblicazione 2',
            'Prima pubblicazione 3',
            '2022-02-02',
            'in corso',
            '2022-01-01',
            'Cavasinni',
            'Finanziatore',
            'Finanziatore2',
            'Finanziatore3',
            'Di Prova',
            'Di Prova2',
            'Di Prova3',
            'Ricercatore',
            'Ricercatore2',
            'Ricercatore3'
        ]);
    }

    public function test_page_not_found_contains_data()
    {
        $this->assertGuest();

        $response = $this->get('/project-dashboard/4');

        $response->assertStatus(200);
        $response->assertSee(["errore","Progetto non trovato"]);
        $response->assertDontSee([
            '<p class="card-text" >Primo Progetto',
            '<p class="card-text" >Un progetto a caso',
            'Admin Admin',
            '../users/1',
            '../users/4',
            '../users/7',
            '../users/8',
            '../users/2',
            '../users/5',
            '../users/6',
            '../budgets/1',
            '../budgets/2',
            '../budgets/3',
            '../pubblicazioni/1',
            '../pubblicazioni/2',
            '../pubblicazioni/3',
            'Prima pubblicazione 1',
            'Prima pubblicazione 2',
            'Prima pubblicazione 3',
            '2022-02-02',
            'in corso',
            '2022-01-01',
            'Cavasinni',
            'Finanziatore',
            'Finanziatore2',
            'Finanziatore3',
            'Di Prova',
            'Di Prova2',
            'Di Prova3',
            'Ricercatore',
            'Ricercatore2',
            'Ricercatore3'
        ],false);
    }

}
