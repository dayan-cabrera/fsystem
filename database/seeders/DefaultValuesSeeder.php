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
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('empresas')->insert([
            'nombre' => 'Empresa A',
            'direccion' => 'Calle 123',
            'telefono' => '123456789',
            'director' => 'Juan Pérez',
            'recursos_humanos' => 'María García',
            'contabilidad' => 'Carlos López',
            'secretario' => 'Ana Torres',
            'logo' => 'empresa.jpg',
        ]);

        DB::table('almacens')->insert([
            [
                'id_empresa' => 1,
                'condrefrigerado' => true,
                'nombre' => 'Almacén Central',
                'mantorep' => false,
                'fecha_mant' => '2024-05-21',
            ],
            [
                'id_empresa' => 1,
                'condrefrigerado' => false,
                'nombre' => 'Almacén Secundario',
                'mantorep' => false,
                'fecha_mant' => '2024-06-21',
            ]
        ]);

        DB::table('estantes')->insert(
            [
                [
                    'id_almacen' => 1,
                    'mant' => false,
                    'fecha_mant' => '2024-04-21',
                ],
                [
                    'id_almacen' => 1,
                    'mant' => false,
                    'fecha_mant' => '2024-04-21',
                ],
                [
                    'id_almacen' => 2,
                    'mant' => false,
                    'fecha_mant' => '2024-04-21',
                ],
                [
                    'id_almacen' => 2,
                    'mant' => false,
                    'fecha_mant' => '2024-04-21',
                ]
            ]
        );

        DB::table('pisos')->insert([
            [
                'id_estante' => 1,
                'mant' => false,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_estante' => 1,
                'mant' => false,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_estante' => 2,
                'mant' => false,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_estante' => 2,
                'mant' => false,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_estante' => 3,
                'mant' => false,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_estante' => 3,
                'mant' => false,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_estante' => 4,
                'mant' => false,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_estante' => 4,
                'mant' => false,
                'fecha_mant' => '2024-04-21',
            ]
        ]);

        DB::table('casillas')->insert([
            [
                'id_piso' => 1,
                'mant' => false,
                'ocupada' => true,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_piso' => 2,
                'mant' => false,
                'ocupada' => true,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_piso' => 3,
                'mant' => false,
                'ocupada' => true,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_piso' => 4,
                'mant' => false,
                'ocupada' => true,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_piso' => 5,
                'mant' => false,
                'ocupada' => true,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_piso' => 6,
                'mant' => false,
                'ocupada' => true,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_piso' => 7,
                'mant' => false,
                'ocupada' => true,
                'fecha_mant' => '2024-04-21',
            ],
            [
                'id_piso' => 8,
                'mant' => false,
                'ocupada' => true,
                'fecha_mant' => '2024-04-21',
            ]
        ]);

        DB::table('facturas')->insert([
            [
                'id_empresa' => 1,
                'id_cliente' => 1,
                'tarifa_tr' => 100.00,
                'tarifa_peso' => 50.00,
                'tarifa_tiempo' => 200.00,
                'tarifa_refr' => 150.00,
                'tarifa_af' => 250.00,
                'fecha_acordada' => '2024-04-21',
                'fecha_entrada' => '2024-04-22',
                'fecha_salida' => '2024-04-23',
                'archivado' => false,
            ],
            [
                'id_empresa' => 1,
                'id_cliente' => 2,
                'tarifa_tr' => 100.00,
                'tarifa_peso' => 50.00,
                'tarifa_tiempo' => 200.00,
                'tarifa_refr' => 150.00,
                'tarifa_af' => 250.00,
                'fecha_acordada' => '2024-04-21',
                'fecha_entrada' => '2024-04-22',
                'fecha_salida' => '2024-04-23',
                'archivado' => false,
            ],
            [
                'id_empresa' => 1,
                'id_cliente' => 3,
                'tarifa_tr' => 100.00,
                'tarifa_peso' => 50.00,
                'tarifa_tiempo' => 200.00,
                'tarifa_refr' => 150.00,
                'tarifa_af' => 250.00,
                'fecha_acordada' => '2024-04-21',
                'fecha_entrada' => '2024-04-22',
                'fecha_salida' => '2024-04-23',
                'archivado' => false,
            ]
        ]);

        DB::table('seguridads')->insert([
            [
                'nombre' => 'Refrigerado',
            ],
            [
                'nombre' => 'Frágil',
            ],
            [
                'nombre' => 'Peligroso',
            ],
            [
                'nombre' => 'Seco',
            ]
        ]);

        DB::table('tipo_companias')->insert([
            [
                'tipo' => 'Tecnologia',
            ],
            [
                'tipo' => 'Inmoviliaria',
            ],
            [
                'tipo' => 'Gastronomia',
            ],
            [
                'tipo' => 'Productos del hogar',
            ]
        ]);

        DB::table('prioridads')->insert([
            [
                'prioridad' => 'Urgente',
            ],
            [
                'prioridad' => 'Esfuerzo',
            ],
            [
                'prioridad' => 'Impacto',
            ],
            [
                'prioridad' => 'Importante',
            ]
        ]);

        DB::table('cond_alms')->insert([
            [
                'nombre' => 'Excelente',
            ],
            [
                'nombre' => 'Buena',
            ],
            [
                'nombre' => 'Regular',
            ],
            [
                'nombre' => 'Mala',
            ]

        ]);

        DB::table('companias')->insert([
            [
                'id_tipocomp' => 1,
                'id_seguridad' => 2,
                'id_condalm' => 3,
                'id_prioridad' => 4,
                'id_empresa' => 1,
                'nombre' => 'Compañía Ejemplo Uno',
            ],
            [
                'id_tipocomp' => 4,
                'id_seguridad' => 3,
                'id_condalm' => 2,
                'id_prioridad' => 1,
                'id_empresa' => 1,
                'nombre' => 'Compañía Ejemplo Dos',
            ]
        ]);

        DB::table('tipo_empaquetados')->insert([
            [
                'tipo' => 'Embalaje con papel',
            ],
            [
                'tipo' => 'Embalaje con cartón',
            ],
            [
                'tipo' => 'Embalaje con metal',
            ],
            [
                'tipo' => 'Embalaje con plástico',
            ]
        ]);

        DB::table('tipo_productos')->insert([
            [
                'tipo' => 'Industriales',
            ],
            [
                'tipo' => 'Tecnologico',
            ],
            [
                'tipo' => 'Alimenticio',
            ],
            [
                'tipo' => 'Oficina',
            ]
        ]);

        DB::table('cargas')->insert([
            [
                'nombre' => 'Carga 1',
                'codigo' => 'COD123',
                'fechaexp' => '2024-04-21',
                'peso' => 10.5,
                'condrefrig' => true,
                'id_tipoprod' => 1,
                'id_empaquetado' => 1,
                'id_compania' => 1,
                'id_casilla' => 1,
                'id_cliente' => 1,
            ],
            [
                'nombre' => 'Carga 2',
                'codigo' => 'COD124',
                'fechaexp' => '2024-04-21',
                'peso' => 10.5,
                'condrefrig' => false,
                'id_tipoprod' => 2,
                'id_empaquetado' => 2,
                'id_compania' => 2,
                'id_casilla' => 3,
                'id_cliente' => 2,
            ],
            [
                'nombre' => 'Carga 3',
                'codigo' => 'COD125',
                'fechaexp' => '2024-04-21',
                'peso' => 10.5,
                'condrefrig' => true,
                'id_tipoprod' => 3,
                'id_empaquetado' => 3,
                'id_compania' => 2,
                'id_casilla' => 5,
                'id_cliente' => 2,
            ],
            [
                'nombre' => 'Carga 4',
                'codigo' => 'COD126',
                'fechaexp' => '2024-04-21',
                'peso' => 10.5,
                'condrefrig' => false,
                'id_tipoprod' => 4,
                'id_empaquetado' => 4,
                'id_compania' => 1,
                'id_casilla' => 7,
                'id_cliente' => 4,
            ]
        ]);
    }
}
