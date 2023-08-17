<?php

namespace Database\Factories;

use App\Models\Church;
use App\Models\DrawGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DrawGroup>
 */
class DrawGroupFactory extends Factory
{

    protected $model = DrawGroup::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Relaciona com uma igreja aleatória
            'igreja_id' => Church::all()->random()->id,
            'nome' => $this->faker->word, // Gera um nome aleatório
        ];
    }
}
