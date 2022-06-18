<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    use RefreshDatabase;
    /**
     * test Registrazione
     *
     * @return void
     */
    /** @test */

    public function test_success()  //successo
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $user =[
            'name'=>'Name',
            'surname'=>'Surname',
            'email'=>'register@gmail.com',
            'email_verified_at' => now(),
            'type'=>'Ricercatore',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->post('/register', $user);

        $response->assertRedirect('/home');
   
        $this->assertDatabaseHas('users', [
            'email' => 'register@gmail.com',
        ]);
    }

    public function test_email_already_used()  //non successo
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $user = User::factory()->create([
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'register@gmail.com',
            'email_verified_at' => now(),
            'type' => 'Ricercatore',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $user = [
            'name'=>'NameTwo',
            'surname'=>'SurnameTwo',
            'email'=>'register@gmail.com',
            'email_verified_at' => now(),
            'type'=>'Ricercatore',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        
        $this->assertDatabaseHas('users', [      //Affermare che una tabella nel database contiene record che corrispondono
            'email' => 'register@gmail.com',
            'name' => 'Name',
        ]);

        $this->assertDatabaseMissing('users', [  //Affermare che una tabella nel database non contiene record che corrispondono
            'email' => 'register@gmail.com',
            'name' => 'NameTwo',
        ]);

        $response = $this->post('/register', $user);  //equivalente tasto submit
        //$response->assertRedirect('/'); //si assicura che mi reindirizza alla pagina welcome quando fallisce

    }

}
?>
