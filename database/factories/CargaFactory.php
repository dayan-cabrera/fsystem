<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carga>
 */
class CargaFactory extends Factory
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
            'fechaexp' => $this->faker->date(),
            'peso' => $this->faker->randomFloat(2, 1, 100),
            'condrefrig' => $this->faker->boolean,
            'id_tipoprod' => \App\Models\TipoProducto::factory(),
            'id_empaquetado' => \App\Models\TipoEmpaquetado::factory(),
            'id_compania' => \App\Models\Compania::factory(),
            'id_casilla' => \App\Models\Casilla::factory(),
            'id_cliente' => \App\Models\Cliente::factory(),
        ];
    }
}
