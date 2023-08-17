<?php

namespace Database\Seeders;

use App\Models\DrawGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrawGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DrawGroup::factory(20)->create(); // Cria 20 grupos de sorteios usando a factory
    }
}
