<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $stato=['in corso','concluso','cancellato'];
        $id_responsabili=DB::table('users')->pluck('id');
        return [
            'nome' => "nomeTest",
            'id_responsabile'=>$this->faker->randomElement($id_responsabili),
            'descrizione' => "descrizioneTest",
            'data_inizio' => "2022-01-01",
            'data_fine' => "2023-01-01",
            'stato' => $stato[rand(0,2)]
        ];
    }
}
