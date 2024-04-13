<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UserController;
use App\Models\Rol;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;


route::get('/', function(){
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

    
});