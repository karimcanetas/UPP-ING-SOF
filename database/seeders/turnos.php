<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class turnos extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql_2';
    public function run(): void
    {
        DB::table('turnos')->insert([
            ['id_turnos' => 1, 'turno' => 'Matutino', 'Hora_inicio' => '06:30:00', 'Hora_Fin' => '18:30:00'],
            ['id_turnos' => 2, 'turno' => 'Nocturno', 'Hora_inicio' => '18:30:00', 'Hora_Fin' => '06:30:00'],
        ]);
    }
}
