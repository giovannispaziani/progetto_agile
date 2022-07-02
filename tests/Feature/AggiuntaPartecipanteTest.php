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


        $response = $this->actingAs($ricercatore)
        ->get("/project-dashboard/2/add-ricercatore/$ricercatore->id");
        $response->assertStatus(403);
    }

    public function test_aggiunta_as_responsabile(){

        $this->seed();

        $user = User::factory()->create([
            'name' => 'ricercatore2',
            'surname' => 'Ricercatore2',
            'email' => 'ricerca3@ric.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $id_responsabile=DB::table("projects")->where("id",1)->pluck("id_responsabile");
        $responsabile=User::where("id",1)->first();
        $response=$this->actingAs($responsabile)->get("/project-dashboard/1/add-ricercatore/$user->id");
        $this->assertDatabaseHas('research_groups',[
            'id_progetto'=> 1,
            'id_ricercatore' => $user->id,
        ]);
    }
}
