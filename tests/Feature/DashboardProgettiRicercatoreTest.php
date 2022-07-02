<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Seeder;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DashboardProgettiRicercatoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_researcher_dashboard_page()  //restituisce la pagina se l'utente è loggato
    {
        $this->seed();


        $user = User::factory()->create([
            'name' => 'Ricercatore',
            'surname' => 'Di Prova',
            'email' => 'ricercatore@prova.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('secret'),
            'studi' => 'Fisica',
            'occupazione' => 'Fisico Nucleare',
            'linkedin' => 'https://it.linkedin.com/in/antorossi',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $response = $this->actingAs($user)->get("/dashboardProgettiRicercatore"); //controlla se passa il parametro (id) alla rotta

        $response->assertStatus(200); //si assicura che venga fornita la pagina

    }

    public function test_get_researcher_dashboard_user_logged()
    {
        $this->seed();

        $user = User::where('id', 2)->first();

        $response = $this->actingAs($user)->get("/dashboardProgettiRicercatore"); //controlla se passa il parametro (id) alla rotta
        $response->assertStatus(200); //si assicura che venga fornita la pagina

        $response->assertSee([  //si assicura che la pagina carichi i dati
            'Primo Progetto',
            'Un progetto a caso',
            "2022-01-01",
            "2022-02-02",
            'Secondo Progetto',
            'Un secondo progetto a caso',
            "2022-01-01",
            "2022-02-02",
            'Terzo Progetto',
            'Un terzo progetto a caso',
            "2022-01-01",
            "2022-02-02",
            'Quarto Progetto',
            'Un quarto progetto a caso',
            "2022-01-01",
            "2022-09-02",
            'Quinto Progetto',
            'Un quinto progetto a caso',
            "2022-01-01",
            "2022-01-20",
            'Sesto Progetto',
            'Un sesto progetto a caso',
            "2022-01-01",
            "2022-04-02",
            'Settimo Progetto',
            'Un settimo progetto a caso',
            "2022-01-09",
            "2022-12-02",
            'Ottavo Progetto',
            'Un ottavo progetto a caso',
            "2022-01-03",
            "2022-02-20",
            'Nono Progetto',
            'Un nono progetto a caso',
            "2022-01-01",
            "2022-05-03"
        ]);
    }

}
?>
