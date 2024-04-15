<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Piso>
 */
class PisoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_estante' => \App\Models\Estante::factory(),
            'mant' => $this->faker->boolean,
            'fecha_mant' => $this->faker->date(),
        ];
    }
}
