<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Facades\DB;

class casetas extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql_2'; //bd vigilancia
    public function run(): void
    {
        DB::table('casetas')->insert([
            ['id_casetas' => 1, 'id_sucursal' => 1, 'nombre' => 'Caseta Servicio', 'status' => 1],
            ['id_casetas' => 2, 'id_sucursal' => 2, 'nombre' => 'Caseta Servicio', 'status' => 1],
            ['id_casetas' => 3, 'id_sucursal' => 3, 'nombre' => 'Área de Demos', 'status' => 1],
            ['id_casetas' => 4, 'id_sucursal' => 4, 'nombre' => 'Área de Demos', 'status' => 1],
            ['id_casetas' => 5, 'id_sucursal' => 5, 'nombre' => 'Caseta Subaru', 'status' => 1],
            ['id_casetas' => 6, 'id_sucursal' => 6, 'nombre' => 'Área de Demos', 'status' => 1,],
            ['id_casetas' => 7, 'id_sucursal' => 1, 'nombre' => 'Caseta Subaru', 'status' => 1,],
            ['id_casetas' => 8, 'id_sucursal' => 2, 'nombre' => 'Caseta Portón rojo', 'status' => 1],
            ['id_casetas' => 9, 'id_sucursal' => 3, 'nombre' => 'Encierro', 'status' => 1],
            ['id_casetas' => 10, 'id_sucursal' => 4, 'nombre' => 'Encierro', 'status' => 1],
            ['id_casetas' => 12, 'id_sucursal' => 6, 'nombre' => 'Encierro', 'status' => 1],
            ['id_casetas' => 16, 'id_sucursal' => 3, 'nombre' => 'Postventa', 'status' => 1],
            ['id_casetas' => 17, 'id_sucursal' => 6, 'nombre' => 'Postventa', 'status' => 1],

        ]);
    }
}
