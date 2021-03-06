<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class RegisterFinTest extends TestCase
{
    use RefreshDatabase;

     /** @test */
    public function view_register_by_manager()
    {
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

        $response = $this->actingAs($manager)
        ->get("/registerFin");
        $response->assertStatus(200);
    }
     /** @test */
    public function view_register_by_other_user()
    {
        $finanziatore = User::factory()->create([
            'name' => 'manager',
            'surname' => 'Manager',
            'email' => 'rmanagejbbjt@ric.com',
            'email_verified_at' => now(),
            'type' => 'Finanziatore',
            'password' => Hash::make('secret'),
            'studi' => 'superiori',
            'occupazione' => 'fisico',
            'linkedin' => 'https://it.linkedin.com/',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->actingAs($finanziatore)
        ->get("/registerFin");
        $response->assertStatus(403);
    }
     /** @test */
    public function register_by_manager(){
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
       
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
        $response = $this->actingAs($manager)
        ->post('/registerFin',[
           'name' => "matteo",
           'surname' => "test",
           'email' => "agvvdgha@hoil.com",
           'password' => "bhvgsbdvj"
        ]);

        $this->assertDatabaseHas('users',[
            'name' => "matteo",
           'surname' => "test",
           'type' => "Finanziatore",
           'email' => "agvvdgha@hoil.com"
        ]);
        
    }
     /** @test */
    public function register_by_other(){
       
        $ricercatore = User::factory()->create([
            'name' => 'ric',
            'surname' => 'snjr',
            'email' => 'rmankhvhlt@ric.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $response = $this->actingAs($ricercatore)
        ->post('/registerFin',[
           'name' => "matteo",
           'surname' => "test",
           'email' => "agvvdgha@hoil.com",
           'password' => "bhvgsbdvj"
        ]);

        $this->assertDatabaseMissing('users',[
            'name' => "matteo",
           'surname' => "test",
           'type' => "Finanziatore",
           'email' => "agvvdgha@hoil.com"
        ]);
        
    }
}
