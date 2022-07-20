<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StatoAvanzamentoLavoriTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_get_sal_page() {

        $this->seed();

        $user = User::where('id', 4)->first();

        $response = $this->actingAs($user)
                        ->get('/statoAvanzamentoLavori/1');

        $response->assertStatus(200);

    }

    public function test_sal_contains_data() {

        $this->seed();

        $user = User::where('id', 4)->first();

        $response = $this->actingAs($user)
                        ->get('/statoAvanzamentoLavori/1');

        $response->assertStatus(200);
        $response->assertSee([
            'Data stimata fine: 2022-02-02',
            'Primo Progetto',
            'Un progetto a caso',
            '2022-01-01'
        ]);
    }

}
