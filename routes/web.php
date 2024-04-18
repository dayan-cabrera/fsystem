<?php

use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CargaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UserController;
use App\Models\Rol;
use Illuminate\Support\Facades\Route;


route::get('/', function () {
    return Rol::all();
});
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
    route::get('/cargas/create', [CargaController::class, 'create'])->name('carga.create');
    route::get('/cargas/create/edit/{id}', [CargaController::class, 'edit'])->name('carga.edit');
    route::post('/cargas/create/store', [CargaController::class, 'store'])->name('carga.store');
    route::put('/cargas/create/update/{id}', [CargaController::class, 'update'])->name('carga.update');
    route::delete('/cargas/destroy/{id}', [CargaController::class, 'destroy'])->name('carga.destroy');

    // Rutas referentes a la gestion de cargas
    route::get('/almacenes', [AlmacenController::class, 'index'])->name('almacen.index');
    route::get('/almacenes/create', [AlmacenController::class, 'create'])->name('almacen.create');
    route::get('/almacenes/create/edit/{id}', [AlmacenController::class, 'edit'])->name('almacen.edit');
    route::post('/almacenes/create/store', [AlmacenController::class, 'store'])->name('almacen.store');
    route::put('/almacenes/create/update/{id}', [AlmacenController::class, 'update'])->name('almacen.update');
    route::delete('/almacenes/destroy/{id}', [AlmacenController::class, 'destroy'])->name('almacen.destroy');
    route::patch('/almacenes/poner-mantenimiento/{id}', [AlmacenController::class, 'ponerEnMantenimiento'])->name('almacen.p_mant');
    route::patch('/almacenes/quitar-mantenimiento/{id}', [AlmacenController::class, 'quitarDeMantenimiento'])->name('almacen.q_mant');
    route::get('/almacenes/mantenimiento', [AlmacenController::class, 'mantIndex'])->name('mant.index');
    route::get('/almacenes/mantenimiento/{id}', [AlmacenController::class, 'mantEdit'])->name('mant.edit');
});
