<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            DefaultValuesSeeder::class
        ]);

        User::create([
            'name' => 'Admin',
            'password' => bcrypt('1'),
        ])->syncRoles('Administrador');

        User::create([
            'name' => 'User',
            'password' => bcrypt('1'),
        ])->syncRoles('Usuario');



        // Empresa::factory(1)->create();
        // Almacen::factory(10)->create();
        // Estante::factory(10)->create();
        // Piso::factory(10)->create();
        // Casilla::factory(10)->create();
        // Factura::factory(10)->create();
        // Seguridad::factory(10)->create();
        // TipoCompania::factory(10)->create();
        // Prioridad::factory(10)->create();
        // CondAlm::factory(10)->create();
        // Compania::factory(10)->create();
        // TipoEmpaquetado::factory(10)->create();
        // TipoProducto::factory(10)->create();
        // Carga::factory(10)->create();
    }
}
