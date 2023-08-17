<?php

namespace Database\Factories;

use App\Models\Draw;
use App\Models\Prize;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prize>
 */
class PrizeFactory extends Factory
{

    protected $model = Prize::class;
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
            'nome' => $this->faker->word, // Gera um nome aleatório
        ];
    }
}
