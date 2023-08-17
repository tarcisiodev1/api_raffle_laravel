<?php

namespace Database\Seeders;

use App\Models\Draw;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrawSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Draw::factory(30)->create(); // Cria 30 sorteios usando a factory
    }
}
