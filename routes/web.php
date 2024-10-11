<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\CasetasController;
use App\Http\Controllers\IncidenciaController;

// Ruta de la vista Welcome
Route::get('/', function () {
    return view('welcome');
});

// Ruta de la vista del login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta del acceso al perfil en el login
Route::middleware('auth')->controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
});

// Vista vigilante
Route::view('/vigilante/vigilante', 'vigilante/vigilante')->name('vigilante');

// Rutas de Sucursales y Empresas
Route::controller(SucursalesController::class)->group(function () {
    Route::get('/sucursales/{id_sucursal}', 'getSucursales');
});

Route::controller(EmpresasController::class)->group(function () {
    Route::get('/empresas', 'index');
    Route::get('/empresas/{id_empresa}/sucursales', 'getSucursales');
});

// Rutas de Casetas e Incidencias
Route::controller(CasetasController::class)->group(function () {
    Route::get('/casetas/{id_sucursal}', 'show');
});

Route::controller(IncidenciaController::class)->group(function () {
    Route::get('/incidencias/create', 'create')->name('incidencias.create');
    Route::post('/incidencias', 'store')->name('incidencias.store');
});

// Autenticacion
require __DIR__ . '/auth.php';
