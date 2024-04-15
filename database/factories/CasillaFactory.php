<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Casilla>
 */
class CasillaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_piso' => \App\Models\Piso::factory(),
            'mant' => $this->faker->boolean,
            'ocupada' => $this->faker->boolean,
            'fecha_mant' => $this->faker->date(),
        ];
    }
}
