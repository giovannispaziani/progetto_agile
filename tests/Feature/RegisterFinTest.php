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
            'studi' => 'Storia Moderna',
            'occupazione' => 'Ricercatore Storia Moderna',
            'linkedin' => 'https://it.linkedin.com/in/veronica-totaro-a9352a71?trk=public_profile_browsemap',
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
            'studi' => '',
            'occupazione' => '',
            'linkedin' => '',
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
            'studi' => 'Scienze delle Comunicazioni',
            'occupazione' => 'PR',
            'linkedin' => 'https://it.linkedin.com/in/melania-d-alessandro-7a168b120?trk=public_profile_browsemap',
             'created_at' => now(),
            'updated_at' => now()
        ]);
        $response = $this->actingAs($manager)
        ->post('/registerFin',[
           'name' => "matteo",
           'surname' => "test",
           'email' => "agvvdgha@hoil.com",
           'password' => "bhvgsbdvj",
           'studi' => 'Storia Moderna',
           'occupazione' => 'Ricercatore Storia Moderna',
           'linkedin' => 'https://it.linkedin.com/in/veronica-totaro-a9352a71?trk=public_profile_browsemap'

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
            'studi' => '',
            'occupazione' => '',
            'linkedin' => '',
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
