<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'nombre' => $this->faker->company,
                'direccion' => $this->faker->address,
                'telefono' => $this->faker->phoneNumber,
                'director' => $this->faker->name,
                'recursos_humanos' => $this->faker->name,
                'contabilidad' => $this->faker->name,
                'secretario' => $this->faker->name,
                'logo' => $this->faker->imageUrl(200, 200, 'business'),
        ];
    }
}
