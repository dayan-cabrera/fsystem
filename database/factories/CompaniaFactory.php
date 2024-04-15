<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compania>
 */
class CompaniaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_tipocomp' => \App\Models\TipoCompania::factory(),
            'id_seguridad' => \App\Models\Seguridad::factory(),
            'id_condalm' => \App\Models\CondAlm::factory(),
            'id_prioridad' => \App\Models\Prioridad::factory(),
            'id_empresa' => \App\Models\Empresa::factory(),
            'nombre' => $this->faker->name,
        ];
    }
}
