<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  

class campos extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql_2'; //bd vigilancia
    public function run()
    {
        DB::table('campos')->insert([
            ['id_campo' => 1, 'campo' => 'id_casetas', 'tipo' => 'INT'],
            ['id_campo' => 2, 'campo' => 'Detalle incidencia', 'tipo' => 'TEXT'],
            ['id_campo' => 3, 'campo' => 'id_formatos', 'tipo' => 'INT'],
            ['id_campo' => 4, 'campo' => 'fecha_hora', 'tipo' => 'DATETIME'],
            ['id_campo' => 5, 'campo' => 'Nombre_vigilante', 'tipo' => 'VARCHAR'],
            ['id_campo' => 6, 'campo' => 'id_turnos', 'tipo' => 'INT'],
            ['id_campo' => 7, 'campo' => 'Lt Gasolina Inicial', 'tipo' => 'DECIMAL'],
            ['id_campo' => 8, 'campo' => 'Lt Gasolina Final', 'tipo' => 'DECIMAL'],
            ['id_campo' => 9, 'campo' => 'Folio/Salida definitiva', 'tipo' => 'VARCHAR'],
            ['id_campo' => 10, 'campo' => 'Asesor', 'tipo' => 'VARCHAR'],
            ['id_campo' => 11, 'campo' => 'Color', 'tipo' => 'VARCHAR'],
            ['id_campo' => 12, 'campo' => 'Fecha', 'tipo' => 'DATE'],
            ['id_campo' => 13, 'campo' => 'Hora', 'tipo' => 'TIME'],
            ['id_campo' => 14, 'campo' => 'VIN (6 últimos dígitos)', 'tipo' => 'DECIMAL'],
            ['id_campo' => 15, 'campo' => 'Unidad', 'tipo' => 'SELECT'],
            ['id_campo' => 16, 'campo' => 'Nombre Taller', 'tipo' => 'VARCHAR'],
            ['id_campo' => 17, 'campo' => 'Persona (Proveedor)', 'tipo' => 'VARCHAR'],
            ['id_campo' => 18, 'campo' => 'Folio / Num de pase', 'tipo' => 'VARCHAR'],
            ['id_campo' => 19, 'campo' => 'Persona(Cliente - Asociado)', 'tipo' => 'VARCHAR'],
            ['id_campo' => 20, 'campo' => 'Otro', 'tipo' => 'VARCHAR'],
            ['id_campo' => 21, 'campo' => 'Puerta', 'tipo' => 'VARCHAR'],
            ['id_campo' => 22, 'campo' => 'Luces', 'tipo' => 'VARCHAR'],
            ['id_campo' => 23, 'campo' => 'Aire Acondicionado', 'tipo' => 'VARCHAR'],
            ['id_campo' => 24, 'campo' => 'TV', 'tipo' => 'VARCHAR'],
            ['id_campo' => 25, 'campo' => 'Ubicación de la unidad', 'tipo' => 'VARCHAR'],
        ]);
    }
}
