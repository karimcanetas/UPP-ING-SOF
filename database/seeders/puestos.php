<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class puestos extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql'; //bd concentradora
    public function run(): void
    {
        DB::table('puestos')->insert([
            [
                'id_puesto' => 1,
                'nombre' => 'Desarrollador',
                'id_nivel' => 4,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 2,
                'nombre' => 'Implementador de proyectos',
                'id_nivel' => 6,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 3,
                'nombre' => 'Jefe TI',
                'id_nivel' => 6,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 4,
                'nombre' => 'Coordinador TI',
                'id_nivel' => 5,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 5,
                'nombre' => 'Coordinador de compras',
                'id_nivel' => 5,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 6,
                'nombre' => 'Gerencia de tesoreria',
                'id_nivel' => 8,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 7,
                'nombre' => 'Jefe de tesoreria',
                'id_nivel' => 6,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 8,
                'nombre' => 'Coordinador de tesoreria',
                'id_nivel' => 5,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 9,
                'nombre' => 'Encargado de asuntos legales',
                'id_nivel' => 5,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 10,
                'nombre' => 'facturista',
                'id_nivel' => 4,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 11,
                'nombre' => 'cajero staff',
                'id_nivel' => 3,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 12,
                'nombre' => 'cuentas por pagar',
                'id_nivel' => 3,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 13,
                'nombre' => 'Cajero',
                'id_nivel' => 2,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 14,
                'nombre' => 'Diligenciero',
                'id_nivel' => 1,
                'created_at' => '2024-08-02 18:28:34',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_puesto' => 15,
                'nombre' => 'Practicante',
                'id_nivel' => 1,
                'created_at' => '2024-07-30 14:46:45',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
        ]);
    }
}
