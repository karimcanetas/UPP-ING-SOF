<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\CasetasController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\TurnosController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/vigilante/vigilante', function () {
    return view('vigilante/vigilante');
})->name('vigilante');
Route::get('/sucursales/{id_sucursal}', [SucursalesController::class, 'getSucursales']);
Route::get('/empresas', [EmpresasController::class, 'index']);
Route::get('/empresas/{id_empresa}/sucursales', [EmpresasController::class, 'getSucursales']);


require __DIR__.'/auth.php';




// Ruta para obtener todas las empresas
Route::get('/empresas', [EmpresasController::class, 'index']);

// Ruta para obtener las sucursales de una empresa específica
Route::get('/empresas/{id_empresa}/sucursales', [EmpresasController::class, 'getSucursales']);
Route::get('/casetas/{id_sucursal}', [CasetasController::class, 'show']);
Route::get('/incidencias/create', [IncidenciaController::class, 'create'])->name('incidencias.create');
Route::post('/incidencias', [IncidenciaController::class, 'store'])->name('incidencias.store');
Route::get('/incidencias', [IncidenciaController::class, 'update'])->name('incidencias.update');

// Ruta para mostrar la vista con los turnos
Route::get('/crear-incidencia', [TurnosController::class, 'index'])->name('crear-incidencia');














