<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\CasetasController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\EmpleadosCatologoController;
use App\Http\Controllers\CorreosController;
use App\Http\Controllers\CorreosFormatosController;
use App\Http\Controllers\FormatosController;
use App\Models\CorreosFormatos;
use App\Models\Formato;

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

// ruta incidencias
Route::controller(IncidenciaController::class)->group(function () {
    Route::get('/incidencias/create', 'create')->name('incidencias.create');
    Route::post('/incidencias', 'store')->name('incidencias.store');
});

//ruta de Empleados
Route::controller(EmpleadosCatologoController::class)->group(function () {
    Route::post('/empleados/store', 'store')->name('empleados.store');
});

//ruta de correos
Route::resource('correos', CorreosController::class);
Route::get('/correos/{id}', [FormatosController::class, 'getCorreos']);
Route::get('/empresas/{id_empresa}/sucursales', [EmpresasController::class, 'getSucursales']);
Route::get('/empresas', [EmpresasController::class, 'index'])->name('empresas.index');
// Ruta para obtener las casetas de una sucursal
Route::get('/sucursales/{id}/casetas', [CasetasController::class, 'getCasetas'])->name('sucursales.casetas');

// Ruta para obtener los formatos de una caseta
Route::get('/casetas/{id}/formatos', [CasetasController::class, 'getFormatos'])->name('casetas.formatos');
Route::post('/correos', [CorreosController::class, 'store'])->name('correos.store');
Route::post('/correos_formatos', [CorreosFormatosController::class, 'store'])->name('correos_formatos.store');
Route::get('/correos', [CorreosController::class, 'index'])->name('correos.index');
Route::post('/correos_formatos', [CorreosFormatos::class, 'store']);
Route::post('/correos_formatos', [CorreosFormatosController::class, 'store'])->name('correos_formatos.store');
Route::get('/correos_formatos',[CorreosFormatosController::class, 'store']);



// Autenticacion
require __DIR__ . '/auth.php';
