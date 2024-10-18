<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\campos;
use Database\Seeders\casetas;
use Database\Seeders\area_departamentos;
use Database\Seeders\condicion_salida;
use Database\Seeders\formatos;
use Database\Seeders\formato_caseta;
use Database\Seeders\motivo_visita;
use Database\Seeders\ubicacion_unidad;
use Database\Seeders\unidad;
use Database\Seeders\unidades_utilitarias;
use Database\Seeders\departamentos;
use Database\Seeders\departamento_puesto;
use Database\Seeders\empleados;
use Database\Seeders\empleado_sucursal;
use Database\Seeders\empresas;
use Database\Seeders\niveles;
use Database\Seeders\sucursales;
use Database\Seeders\suc_dep;
use Database\Seeders\tipo_asociados;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
    public function run(): void
    {
        //VIGILANCIA PRT
        // User::factory(10)->create();
        //lamar a campos
        $this->call(campos::class);
        //llamar a Area departamentos (SELECT)
        $this->call(area_departamentos::class);
        //llamar a las casetas disponibles
        $this->call(casetas::class);
        //llamar a condicion salida (SELECT)
        $this->call(condicion_salida::class);
        //lamar a los formatos
        $this->call(formatos::class);
        //llamar a formato caseta
        $this->call(formato_caseta::class);
        //lamar a motivo visita (SELECT)
        $this->call(motivo_visita::class);
        //turnos
        $this->call(turnos::class);
        //llamar a ubicacion_unidad (SELECT)
        $this->call(ubicacion_unidad::class);
        //llamar a unidad (SELECT)
        $this->call(unidad::class);
        //llamar a unidades_utilitarias (SELECT)
        $this->call(unidades_utilitarias::class);

        //CONCENTRADORA
        //departamentos
        $this->call(departamentos::class);
        //departamentos y los puestos que existen
        $this->call(departamento_puesto::class);
        //empleados
        $this->call(empleados::class);
        //relacion
        $this->call(empleado_sucursal::class);
        //empresas existentes
        $this->call(empresas::class);
        //niveles
        $this->call(niveles::class);
        //puestos
        $this->call(puestos::class);
        //sucursales 
        $this->call(sucursales::class);
        //sucusales_departamentos
        $this->call(suc_dep::class);
        //tipo asociadods
        $this->call(tipo_asociados::class);



        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
