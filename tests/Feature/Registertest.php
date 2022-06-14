<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class Registertest extends TestCase
{
    use RefreshDatabase;
    /**
     * test Registrazione
     *
     * @return void
     */
    public function register_test_succ()  //successo
    {
        $user =[
            'name'=>'Name',
            'surname'=>'Surname',
            'email'=>'register@gmail.com',
            'password'=>'secret',
            'password_confirmation'=>'secret'
        ];


        $response = $this->post('/register', user);

        $response->assertRedirect('/home');
    }

   
}
