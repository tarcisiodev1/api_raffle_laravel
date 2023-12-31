<?php

namespace Database\Factories;

use App\Models\Draw;
use App\Models\Participant;
use App\Models\Prize;
use App\Models\Winner;
use Illuminate\Database\Eloquent\Factories\Factory;

class WinnerFactory extends Factory
{
    protected $model = Winner::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $participant = Participant::inRandomOrder()->first();
        $draw = Draw::inRandomOrder()->first();

        return [
            'sorteio_id' => $draw->id,
            'premio_id' => Prize::all()->random()->id,
            'participante_id' => $participant->id
        ];
    }

    /**
     * Define a unique state where there is only one winner per draw
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
}
