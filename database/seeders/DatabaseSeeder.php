<?php

namespace Database\Seeders;

use App\Models\Almacen;
use App\Models\Carga;
use App\Models\Casilla;
use App\Models\Cliente;
use App\Models\Compania;
use App\Models\CondAlm;
use App\Models\Empresa;
use App\Models\Estante;
use App\Models\Factura;
use App\Models\Piso;
use App\Models\Prioridad;
use App\Models\Seguridad;
use App\Models\TipoCompania;
use App\Models\TipoEmpaquetado;
use App\Models\TipoProducto;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class
        ]);

        User::create([
            'name' => 'Admin',
            'password' => bcrypt('1'),
        ])->syncRoles('Administrador');

        User::create([
            'name' => 'User',
            'password' => bcrypt('1'),
        ])->syncRoles('Usuario');



        Cliente::factory(10)->create();
        Empresa::factory(1)->create();
        Almacen::factory(10)->create();
        Estante::factory(10)->create();
        Piso::factory(10)->create();
        Casilla::factory(10)->create();
        Factura::factory(10)->create();
        Seguridad::factory(10)->create();
        TipoCompania::factory(10)->create();
        Prioridad::factory(10)->create();
        CondAlm::factory(10)->create();
        Compania::factory(10)->create();
        TipoEmpaquetado::factory(10)->create();
        TipoProducto::factory(10)->create();
        Carga::factory(10)->create();
    }
}
