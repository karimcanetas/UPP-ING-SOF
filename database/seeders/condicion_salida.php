<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class condicion_salida extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql_2'; //bd vigilancia
    public function run(): void
    {
        DB::table('condicion_salida')->insert([
            ['id_condicion' => 1, 'nombre' => 'PAGADO'],
            ['id_condicion' => 2, 'nombre' => 'GARANTÍA'],
        ]);
    }
}
