<?php

namespace Database\Factories;

use App\Models\Draw;
use App\Models\DrawGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Draw>
 */
class DrawFactory extends Factory
{

    protected $model = Draw::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Relaciona com um grupo de sorteios aleatório
            'grupo_id' => DrawGroup::all()->random()->id,
            'nome' => $this->faker->sentence, // Gera uma frase aleatória
            'quantidade_premios' => $this->faker->numberBetween(1, 10), // Gera um número entre 1 e 10
            'data_expiracao' => $this->faker->dateTimeBetween('+1 week', '+1 month'), // Gera uma data entre 1 semana e 1 mês no futuro
            'status' => $this->faker->boolean, // Escolhe aleatoriamente entre valores booleanos
        ];
    }
}
