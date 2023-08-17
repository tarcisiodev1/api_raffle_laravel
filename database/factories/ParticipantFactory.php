<?php

namespace Database\Factories;

use App\Models\Draw;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participant>
 */
class ParticipantFactory extends Factory
{

    protected $model = Participant::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Relaciona com um sorteio aleatório
            'sorteio_id' => Draw::all()->random()->id,
            'nome' => $this->faker->name, // Gera um nome aleatório
            'quantidade_bilhetes' => $this->faker->numberBetween(1, 5), // Gera um número entre 1 e 5
        ];
    }
}
