<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Budget;
use Illuminate\Support\Facades\Hash;

class DashboardAcquistiTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_view_page()
    {
        $this->seed();

        $user=User::where("id",1)->first();
        $response = $this->actingAs($user)->get('/project-list-responsabile');

        $response->assertStatus(200);
    }
    public function test_get_not_responsabile()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->seed();

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

        $response=$this->actingAs($user)->get('/dashboard-budget/1');
        $response->assertStatus(403);
    }

    public function test_post_ricercatore_not_responsabile()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->seed();

        $ricercatore = User::factory()->create([
            'name' => 'Ricercatore',
            'surname' => 'Di Prova',
            'email' => 'ricercatoreo89@prova.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $spesa= Budget::factory()->create([
            'id_progetto'=>1,
            'id_ricercatore'=>$ricercatore->id,
            'scopo'=>"Divulgazione",
            'budget'=>100,
            'stato'=>"in corso"
        ]);

        $response = $this->actingAs($ricercatore)->post("accept-budget" ,[
            "id_progetto" => 1,
            "id_spesa" => $spesa->id,
        ]);
        $response->assertStatus(403);
    }

    public function test_get_responsabile()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->seed();

        $user = User::where("id",1)->first();

        $response=$this->actingAs($user)->get('/dashboard-budget/1');
        $response->assertStatus(200);
    }

    public function test_post_accepted_responsabile()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->seed();

        $user = User::where("id",1)->first();
        $spesa= Budget::factory()->create([
            'id_progetto'=>1,
            'id_ricercatore'=>1,
            'scopo'=>"Altro",
            'budget'=>100,
            'stato'=>"in corso"
        ]);

        $response = $this->actingAs($user)->post("aggiungiVoce" ,[
            "progetto" => 1,
            "budget" => $spesa->id,
        ]);
        $this->assertDatabaseHas( 'budgets',[
            "id" => $spesa->id,
            "id_progetto" => 1,
            'scopo'=>"Altro",
            'budget'=>100,
            'stato'=>"in corso"
        ]);
    }

    public function test_post_refuse_responsabile(){
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $this->seed();

        $user = User::where("id",1)->first();
        $spesa= Budget::factory()->create([
            'id_progetto'=>1,
            'id_ricercatore'=>1,
            'scopo'=>"Materiali",
            'budget'=>100,
            'stato'=>"in corso"
        ]);

        $response = $this->actingAs($user)->post("aggiungiVoce" ,[
            "progetto" => 1,
            "budget" => $spesa->id,
        ]);
        $this->assertDatabaseHas( 'budgets',[
            "id" => $spesa->id,
            "id_progetto" => 1,
            'scopo'=>"Materiali",
            'budget'=>100,
            'stato'=>"in corso"
        ]);

    }
}
