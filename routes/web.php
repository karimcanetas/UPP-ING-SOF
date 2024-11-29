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
use App\Http\Controllers\EmpleadosFormatosController;
use App\Models\EmpleadosCatalogo;

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
    return view('EmpleadoFormato.index');
})->middleware(['auth', 'verified'])->name('index');

Route::get('/EmpleadoFormato/index', function () {
    return view('EmpleadoFormato.index');
})->middleware(['auth', 'verified'])->name('EmpleadoFormato.index');

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
    Route::get('/empleados/{sucursalId}/{departamentoId}', 'usuariosEmails')->name('empleados.usuariosEmails');
});

// Rutas 'correos'
Route::resource('correos', CorreosController::class)->names([
    'index' => 'correos.index',
    'store' => 'correos.store',
]);

// Rutas de EmpresasController
Route::controller(EmpresasController::class)->group(function () {
    Route::get('/empresas', 'index')->name('empresas.index');
    Route::get('/empresas/{id_empresa}/sucursales', 'getSucursales');
});

// Rutas de CasetasController
Route::controller(CasetasController::class)->group(function () {
    Route::get('/sucursales/{id}/casetas', 'getCasetas')->name('sucursales.casetas');
    Route::get('/casetas/{id}/formatos', 'getFormatos')->name('casetas.formatos');
    Route::get('/sucursales/{sucursalId}/departamentos', 'getDepartamentos')->name('sucursales.departamentos');
});
// Rutas de EmpleadosCatologoController
Route::get('/empleados/{sucursalId}/{departamentoId}', [EmpleadosCatologoController::class, 'usuariosEmails']);

// Rutas de EmpleadosFormatosController
Route::controller(EmpleadosFormatosController::class)->group(function () {
    Route::post('/empleados_formatos', 'store')->name('empleados_formatos.store');
    Route::get('/empleados_formatos', 'store');
});

// Rutas de FormatosController
Route::get('/get-correos/{id}', [FormatosController::class, 'getCorreos'])->name('get.correos');
Route::post('/obtener-campos', [FormatosController::class, 'obtenerCamposPorFormato'])->name('obtener.campos');
Route::get('/checks-formatos', [FormatosController::class, 'checksSeparadores']);

// Rutas de CampoIncidenciasController
Route::post('/exportar-campo-incidencias', [CampoIncidenciasController::class, 'exportar'])->name('exportar.campo.incidencias');
Route::post('/envio', [CampoIncidenciasController::class, 'envio'])->name('envio.correos');


Route::get('/empleados/formatos', [EmpleadosCatologoController::class, 'obtenerTodosLosFormatos']);
Route::put('/empleados/actualizar-status/{empleadoId}/{formatoId}', [EmpleadosCatologoController::class, 'actualizarStatus']);

//ruta envio vigilante 
Route::post('/envio-vigilante', [CampoIncidenciasController::class, 'EnvioVigilante'])->name('envio.vigilante');
// Autenticacion
require __DIR__ . '/auth.php';
