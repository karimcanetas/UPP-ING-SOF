<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Incidencia;
use App\Models\Formato;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Cargar incidencias
        $incidencias = Incidencia::with('caseta', 'turno', 'formato')->get();
        // $formatos = Formato::with('correos')->get();

        // Compartir incidencias y formatos con todas las vistas
        View::share('incidencias', $incidencias);
        // View::share('formatos', $formatos);
    }
}
