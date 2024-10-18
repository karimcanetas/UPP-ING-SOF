<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;

class area_departamentos extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql_2'; //bd vigilancia
    public function run(): void
    {
        DB::table('area_departamento')->insert([
            ['id_areadep' => 1, 'nombre' => 'DESARROLLO ORGANIZACIONAL'],
            ['id_areadep' => 2, 'nombre' => 'MEDIO AMBIENTE'],
            ['id_areadep' => 3, 'nombre' => 'SERVICIO'],
            ['id_areadep' => 4, 'nombre' => 'REFACCIONES'],
            ['id_areadep' => 5, 'nombre' => 'ÁREA DE LAVADO UNIDADES'],
            ['id_areadep' => 6, 'nombre' => 'ADMINISTRACIÓN'],
            ['id_areadep' => 7, 'nombre' => 'SISTEMAS'],
            ['id_areadep' => 8, 'nombre' => 'MANTENIMIENTO']
        ]);
    }
}
