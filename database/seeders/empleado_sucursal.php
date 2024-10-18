<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class empleado_sucursal extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql'; //bd concentradora
    public function run(): void
    {
        DB::table('empleado_sucursal')->insert([
            ['id' => 1, 'id_empleado' => 1, 'id_sucursal' => 3],
            ['id' => 2, 'id_empleado' => 2, 'id_sucursal' => 2],
            ['id' => 3, 'id_empleado' => 3, 'id_sucursal' => 1],
            ['id' => 4, 'id_empleado' => 3, 'id_sucursal' => 2],
            ['id' => 5, 'id_empleado' => 3, 'id_sucursal' => 3],
            ['id' => 6, 'id_empleado' => 4, 'id_sucursal' => 1],
        ]);
    }
}
