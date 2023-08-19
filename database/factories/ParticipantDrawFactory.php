<?php

namespace Database\Factories;

use App\Models\Draw;
use App\Models\Participant;
use App\Models\ParticipantDraw;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ParticipantDrawFactory extends Factory
{

    protected $model = ParticipantDraw::class;
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
            'participant_id' => $participant->id,
            'draw_id' => $draw->id,
        ];
    }
}
