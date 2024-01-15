<?php

namespace Database\Seeders;

use App\Models\Jogadores;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JogadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jogadores::factory()->count(10)->create();
    }
}
