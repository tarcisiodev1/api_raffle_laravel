<?php

namespace Database\Seeders;

use App\Models\Winner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WinnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Winner::factory(50)->create(); // Cria 50 ganhadores usando a factory
    }
}
