<?php

namespace Database\Seeders;

use App\Models\ParticipantDraw;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantDrawSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParticipantDraw::factory()
            ->count(50) // Defina o número de registros que deseja criar
            ->create();
    }
}
