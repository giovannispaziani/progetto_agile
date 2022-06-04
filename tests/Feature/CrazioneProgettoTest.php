<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//use Illuminate\Foundation\Auth\User;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CrazioneProgettoTest extends TestCase
{
    public function test_page_get()
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
                         ->get('/create-project');
        
        $response->assertStatus(200);
    }

    public function test_post_as_manager()
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

        DB::table('projects')->where("nome","nomeTest")->delete();

        $response = $this->actingAs($user)
                         ->post('/create-project',[
                            'nome' => "nomeTest",
                            'descrizione' => "descrizioneTest",
                            'inizio' => "2022-01-01",
                            'fine' => "2023-01-01"
                         ]);
        
        $this->assertTrue(DB::table('projects')->where("nome","nomeTest")->exists(),"Project was not created");

        DB::table('projects')->where("nome","nomeTest")->delete();
    }

    public function test_post_as_ricercatore()
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

        DB::table('projects')->where("nome","nomeTest")->delete();

        $response = $this->actingAs($user)
                         ->post('/create-project',[
                            'nome' => "nomeTest",
                            'descrizione' => "descrizioneTest",
                            'inizio' => "2022-01-01",
                            'fine' => "2023-01-01"
                         ]);
        
        $this->assertTrue(!DB::table('projects')->where("nome","nomeTest")->exists(),"Project was created without proper permission (user is not a Manager)");
    }

    public function test_post_as_finanziatore()
    {

        $user = User::factory()->create([
            'name' => 'Finanziatore',
            'surname' => 'Di Prova',
            'email' => 'finanziatore@prova.com',
            'email_verified_at' => now(),
            'type' => 'Finanziatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('projects')->where("nome","nomeTest")->delete();

        $response = $this->actingAs($user)
                         ->post('/create-project',[
                            'nome' => "nomeTest",
                            'descrizione' => "descrizioneTest",
                            'inizio' => "2022-01-01",
                            'fine' => "2023-01-01"
                         ]);
        
        $this->assertTrue(!DB::table('projects')->where("nome","nomeTest")->exists(),"Project was created without proper permission (user is not a Finanziatore)");
    }
}
