<?php

use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CargaController;
use App\Http\Controllers\CasillaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompaniaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EstanteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;

use App\Mail\FSystemMailable;
use Illuminate\Support\Facades\Mail;



route::get('/login', [AuthController::class, 'login'])->name('login');
route::post('/login/auth', [AuthController::class, 'authenticate'])->name('auth');

route::get('/register', [AuthController::class, 'register'])->name('register');
route::post('/register/store', [AuthController::class, 'store'])->name('saveUser');
route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::fallback(function () {
    return redirect()->route('login');
});


route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/email', [EmailController::class, 'index'])->name('email.index');
    Route::post('/enviar-email', [EmailController::class, 'send_email'])->name('enviar.email');


    // Rutas referentes a la gestion de usuario
    route::get('/users', [UserController::class, 'index'])->name('user.index');
    route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    route::get('/users/role/{id}', [UserController::class, 'viewRole'])->name('user.view_role');
    route::put('/users/role/assign/{id}', [UserController::class, 'role'])->name('user.role');

    // Rutas referentes a la gestion cliente
    route::get('/clientes', [ClienteController::class, 'index'])->name('cliente.index');
    route::get('/clientes/create', [ClienteController::class, 'create'])->name('cliente.create');
    route::post('/clientes/create/store', [ClienteController::class, 'store'])->name('cliente.store');
    route::delete('/clientes/destroy/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');


    // Rutas referentes a la gestion de cargas
    route::get('/cargas', [CargaController::class, 'index'])->name('carga.index');
    route::get('/cargas/create/edit/{id}', [CargaController::class, 'edit'])->name('carga.edit');
    route::post('/cargas/create/store', [CargaController::class, 'store'])->name('carga.store');
    route::put('/cargas/create/update/{id}', [CargaController::class, 'update'])->name('carga.update');
    route::delete('/cargas/destroy/{id}', [CargaController::class, 'destroy'])->name('carga.destroy');

    // Rutas referentes a la gestion de almacenes
    route::get('/almacenes', [AlmacenController::class, 'index'])->name('almacen.index');
    route::get('/almacenes/create', [AlmacenController::class, 'create'])->name('almacen.create');
    route::get('/almacenes/edit/{id}', [AlmacenController::class, 'edit'])->name('almacen.edit');
    route::post('/almacenes/store', [AlmacenController::class, 'store'])->name('almacen.store');
    route::put('/almacenes/update/{id}', [AlmacenController::class, 'update'])->name('almacen.update');
    route::delete('/almacenes/destroy/{id}', [AlmacenController::class, 'destroy'])->name('almacen.destroy');
    route::patch('/almacenes/poner-mantenimiento/{id}', [AlmacenController::class, 'ponerEnMantenimiento'])->name('almacen.p_mant');
    route::patch('/almacenes/quitar-mantenimiento/{id}', [AlmacenController::class, 'quitarDeMantenimiento'])->name('almacen.q_mant');
    route::get('/almacenes/mantenimiento/{id}', [AlmacenController::class, 'mantEdit'])->name('almacen.mant.edit');

    // Rutas referentes a la gestion de estantes
    route::get('/almacenes/estantes/{id_alm}', [EstanteController::class, 'index'])->name('estante.index');
    route::get('/almacenes/estantes/create/{id_alm}', [EstanteController::class, 'create'])->name('estante.create');
    route::post('/almacenes/estantes/store', [EstanteController::class, 'store'])->name('estante.store');
    route::delete('/almacenes/estantes/destroy/{id}', [EstanteController::class, 'destroy'])->name('estante.destroy');
    route::patch('/almacenes/estantes/poner-mantenimiento/{id}', [EstanteController::class, 'ponerEnMantenimiento'])->name('estante.p_mant');
    route::patch('/almacenes/estantes/quitar-mantenimiento/{id}', [EstanteController::class, 'quitarDeMantenimiento'])->name('estante.q_mant');
    route::get('/almacenes/estantes/mantenimiento/{id}', [EstanteController::class, 'mantEdit'])->name('estante.mant.edit');


    // Rutas referentes a la gestion de piso
    route::get('/almacenes/pisos/{id_est}', [PisoController::class, 'index'])->name('piso.index');
    route::get('/almacenes/pisos/create/{id_est}', [PisoController::class, 'create'])->name('piso.create');
    route::post('/almacenes/pisos/store', [PisoController::class, 'store'])->name('piso.store');
    route::delete('/almacenes/pisos/destroy/{id}', [PisoController::class, 'destroy'])->name('piso.destroy');
    route::patch('/almacenes/pisos/poner-mantenimiento/{id}', [PisoController::class, 'ponerEnMantenimiento'])->name('piso.p_mant');
    route::patch('/almacenes/pisos/quitar-mantenimiento/{id}', [PisoController::class, 'quitarDeMantenimiento'])->name('piso.q_mant');
    route::get('/almacenes/pisos/mantenimiento/{id}', [PisoController::class, 'mantEdit'])->name('piso.mant.edit');


    // Rutas referentes a la gestion de casillas
    route::get('/almacenes/casillas/{id_piso}', [CasillaController::class, 'index'])->name('casilla.index');
    route::get('/almacenes/casillas/create/{id_piso}', [CasillaController::class, 'create'])->name('casilla.create');
    route::post('/almacenes/casillas/store', [CasillaController::class, 'store'])->name('casilla.store');
    route::delete('/almacenes/casillas/destroy/{id}', [CasillaController::class, 'destroy'])->name('casilla.destroy');
    route::patch('/almacenes/casillas/poner-mantenimiento/{id}', [CasillaController::class, 'ponerEnMantenimiento'])->name('casilla.p_mant');
    route::patch('/almacenes/casillas/quitar-mantenimiento/{id}', [CasillaController::class, 'quitarDeMantenimiento'])->name('casilla.q_mant');
    route::get('/almacenes/casillas/mantenimiento/{id}', [CasillaController::class, 'mantEdit'])->name('casilla.mant.edit');


    route::get('/almacenes/mantenimiento', [MantenimientoController::class, 'index'])->name('mant.index');

    // Rutas referentes a las companias
    route::get('/companias', [CompaniaController::class, 'index'])->name('compania.index');
    route::get('/companias/create', [CompaniaController::class, 'create'])->name('compania.create');
    route::get('/companias/create/edit/{id}', [CompaniaController::class, 'edit'])->name('compania.edit');
    route::post('/companias/create/store', [CompaniaController::class, 'store'])->name('compania.store');
    route::put('/companias/create/update/{id}', [CompaniaController::class, 'update'])->name('compania.update');
    route::delete('/companias/destroy/{id}', [CompaniaController::class, 'destroy'])->name('compania.destroy');

    // Rutas referentes a la gestion facturas
    route::get('/facturas', [FacturaController::class, 'index'])->name('factura.index');
    route::post('/facturas/store/', [FacturaController::class, 'store'])->name('factura.store');
    route::patch('/facturas/update/{id}', [FacturaController::class, 'update'])->name('factura.update');
    route::delete('/facturas/destroy/{id}', [FacturaController::class, 'destroy'])->name('factura.destroy');
    route::get('/facturas/imprimir/{id}', [FacturaController::class, 'imprimir'])->name('factura.imprimir');



    //Rutas referentes a la gestion empresa
    route::get('/empresa', [EmpresaController::class, 'index'])->name('empresa.index');
    route::get('/empresa/edit', [EmpresaController::class, 'edit'])->name('empresa.edit');
    route::put('/empresa/store/', [EmpresaController::class, 'update'])->name('empresa.update');
    route::get('/empresa/imprimir/{id}', [EmpresaController::class, 'imprimir'])->name('empresa.imprimir');


    // rutas referentes a descargar pdf
    route::get('/compania/imprimir/{id}', [CompaniaController::class, 'imprimir'])->name('compania.imprimir');
    route::get('/clientes/imprimir/{id}', [ClienteController::class, 'imprimir'])->name('cliente.imprimir');
    route::get('/almacenes/imprimir/{id}', [AlmacenController::class, 'imprimir'])->name('almacen.imprimir');
    route::get('/cargas/imprimir/{id}', [CargaController::class, 'imprimir'])->name('carga.imprimir');
});
