<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Almacen>
 */
class AlmacenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_empresa'=>\App\Models\Empresa::factory(),
            'condrefrigerado' => $this->faker->boolean,
            'nombre' => $this->faker->name,
            'mantorep' => $this->faker->boolean,
            'fecha_mant' => $this->faker->date(),
        ];
    }
}
