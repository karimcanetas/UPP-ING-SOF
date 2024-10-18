<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class unidades_utilitarias extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql_2';
    public function run(): void
    {
        DB::table('unidades_utilitarias')->insert([
            ['id_unidadut' => 1, 'nombre' => 'HILUX'],
            ['id_unidadut' => 2, 'nombre' => 'HICE REFACCIONES'],
            ['id_unidadut' => 3, 'nombre' => 'YARIS'],
            ['id_unidadut' => 4, 'nombre' => 'HICE ITZAES'],
            ['id_unidadut' => 5, 'nombre' => 'HILUX']
        ]);
    }
}
