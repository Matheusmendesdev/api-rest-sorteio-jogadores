<?php

namespace Database\Factories;

use App\Models\Jogadores;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JogadoresFactory extends Factory
{
    protected $model = Jogadores::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'nivel' => $this->faker->numberBetween(1, 5),
            'goleiro' => $this->faker->boolean,
            'presenca'=> $this->faker->boolean,
        ];
    }
}
