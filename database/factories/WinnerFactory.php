<?php

namespace Database\Factories;

use App\Models\Draw;
use App\Models\Participant;
use App\Models\Prize;
use App\Models\Winner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Winner>
 */
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
        return [
            // Relaciona com um sorteio, prêmio e participante aleatórios
            'sorteio_id' => Draw::all()->random()->id,
            'premio_id' => Prize::all()->random()->id,
            'participante_id' => Participant::all()->random()->id,
        ];
    }
}
