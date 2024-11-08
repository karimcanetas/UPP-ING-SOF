<?php

use App\Http\Controllers\ProfileController;
use App\Mail\ReporteMailable;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\CasetasController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\EmpleadosCatologoController;
use App\Http\Controllers\CorreosController;
use App\Http\Controllers\CorreosFormatosController;
use App\Http\Controllers\FormatosController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\CampoIncidenciasController;

// Ruta de la vista Welcome
Route::get('/', function () {
    return view('welcome');
});

// Ruta de la vista del login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/index', function () {
    return view('send.index');
})->middleware(['auth', 'verified'])->name('index');

Route::get('/send/index', function () {
    return view('send.index');
})->middleware(['auth', 'verified'])->name('send.index');


Route::get('/index', function () {
    return view('CorreoFormato.index');
})->middleware(['auth', 'verified'])->name('index');

Route::get('/CorreoFormato/index', function () {
    return view('CorreoFormato.index');
})->middleware(['auth', 'verified'])->name('CorreoFormato.index');

Route::get('/emails', function () {
    return view('layouts.emails.index');
})->middleware(['auth', 'verified'])->name('emails.index');


// Ruta del acceso al perfil en el login
Route::middleware('auth')->controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name(name: 'profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
});

// Vista vigilante
Route::view('/vigilante/vigilante', 'vigilante/vigilante')->name('vigilante');

// Rutas de Sucursales y Empresas
Route::controller(SucursalesController::class)->group(function () {
    Route::get('/sucursales/{id_sucursal}', 'getSucursales');
});

//RUTA EMPRESAS
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

// Rutas 'correos'
Route::resource('correos', CorreosController::class)->names([
    'index' => 'correos.index',
    'store' => 'correos.store',
]);
// Route::get('/correos/{id}', [FormatosController::class, 'getCorreos']);

// Rutas de EmpresasController
Route::controller(EmpresasController::class)->group(function () {
    Route::get('/empresas', 'index')->name('empresas.index');
    Route::get('/empresas/{id_empresa}/sucursales', 'getSucursales');
});

// Rutas de CasetasController
Route::controller(CasetasController::class)->group(function () {
    Route::get('/sucursales/{id}/casetas', 'getCasetas')->name('sucursales.casetas');
    Route::get('/casetas/{id}/formatos', 'getFormatos')->name('casetas.formatos');
});

// Rutas de CorreosFormatosController
Route::controller(CorreosFormatosController::class)->group(function () {
    Route::post('/correos_formatos', 'store')->name('correos_formatos.store');
    Route::get('/correos_formatos', 'store');
});

Route::get('/get-correos/{id}', [FormatosController::class, 'getCorreos'])->name('get.correos');

// Route::get('Vigilancia', function () {
//     Mail::to('diuitcan@gmail.com')->send(new ReporteMailable);
//     return "Mensaje enviado";
// })->name('Vigilancia');

//exportar
Route::post('/exportar-campo-incidencias', [CampoIncidenciasController::class, 'exportar'])->name('exportar.campo.incidencias');

//obtener formatos
Route::post('/obtener-campos', [FormatosController::class, 'obtenerCamposPorFormato'])->name('obtener.campos');

Route::post('/envio', [CampoIncidenciasController::class, 'envio'])->name('envio.correos');

Route::get('/checks-formatos', [FormatosController::class, 'checksSeparadores']);


// Autenticacion
require __DIR__ . '/auth.php';
