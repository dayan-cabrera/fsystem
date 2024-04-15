<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factura>
 */
class FacturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_empresa' => \App\Models\Empresa::factory(),
            'id_cliente' => \App\Models\Cliente::factory(),
            'tarifa_tr' => $this->faker->randomFloat(2, 1, 100),
            'tarifa_peso' => $this->faker->randomFloat(2, 1, 100),
            'tarifa_tiempo' => $this->faker->randomFloat(2, 1, 100),
            'tarifa_refr' => $this->faker->randomFloat(2, 1, 100),
            'tarifa_af' => $this->faker->randomFloat(2, 1, 100),
            'fecha_acordada' => $this->faker->date(),
            'fecha_entrada' => $this->faker->date(),
            'fecha_salida' => $this->faker->date(),
            'archivado' => $this->faker->boolean,
        ];
    }
}
