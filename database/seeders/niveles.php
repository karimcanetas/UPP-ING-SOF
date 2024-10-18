<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class niveles extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql'; //bd concentradora
    public function run(): void
    {
        DB::table('niveles')->insert([
            [
                'id_nivel' => 1,
                'nombre' => 'auxiliares',
                'orden' => 1,
                'status' => 1,
            ],
            [
                'id_nivel' => 2,
                'nombre' => 'analista-auxiliar',
                'orden' => 2,
                'status' => 1,
            ],
            [
                'id_nivel' => 3,
                'nombre' => 'Asistentes administrativos /  Analistas',
                'orden' => 3,
                'status' => 1,
            ],
            [
                'id_nivel' => 4,
                'nombre' => 'Asesores / Administadores',
                'orden' => 4,
                'status' => 1,
            ],
            [
                'id_nivel' => 5,
                'nombre' => 'Coordinadores',
                'orden' => 5,
                'status' => 1,
            ],
            [
                'id_nivel' => 6,
                'nombre' => 'Jefaturas',
                'orden' => 6,
                'status' => 1,
            ],
            [
                'id_nivel' => 7,
                'nombre' => 'Gerentes de área',
                'orden' => 7,
                'status' => 1,
            ],
            [
                'id_nivel' => 8,
                'nombre' => 'Gerentes corporativos',
                'orden' => 8,
                'status' => 1,
            ],
            [
                'id_nivel' => 9,
                'nombre' => 'Dirección general',
                'orden' => 9,
                'status' => 1,
            ],
        ]);
    }
}
