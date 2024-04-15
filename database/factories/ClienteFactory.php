<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'pais' => $this->faker->country,
            'fax' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'telefono' => $this->faker->phoneNumber,
            'prioridad' => $this->faker->boolean,
            'anos' => $this->faker->numberBetween(1, 100),
            'entidad' => $this->faker->boolean,
            'archivado' => $this->faker->boolean(10),
        ];
    }
}
