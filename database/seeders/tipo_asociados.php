<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipo_asociados extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql'; //bd concentradora
    public function run(): void
    {
        DB::table('tipo_asociados')->insert([
            ['id_tipo_asociado' => 1, 'nombre' => 'Interno', 'status' => 1],
            ['id_tipo_asociado' => 2, 'nombre' => 'Comisionista', 'status' => 1],
            ['id_tipo_asociado' => 3, 'nombre' => 'Implant', 'status' => 1],
            ['id_tipo_asociado' => 4, 'nombre' => 'Practicante', 'status' => 1]
        ]);
    }
}
