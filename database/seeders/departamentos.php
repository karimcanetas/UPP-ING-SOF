<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class departamentos extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql'; //bd concentradora
    public function run(): void
    {
        DB::table('departamentos')->insert([
            [
                'id_departamento' => 1,
                'nombre' => 'Atención a clientes',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 2,
                'nombre' => 'Citas',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 3,
                'nombre' => 'Compras',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 4,
                'nombre' => 'Contraloria',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 5,
                'nombre' => 'Desarrollo Organizacional',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 6,
                'nombre' => 'Direccion',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 7,
                'nombre' => 'Facturacion',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 8,
                'nombre' => 'Financiamiento',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 9,
                'nombre' => 'Fiscal',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 10,
                'nombre' => 'Gerencia',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 11,
                'nombre' => 'HYP',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 12,
                'nombre' => 'Kaizen',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 13,
                'nombre' => 'Legal',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 14,
                'nombre' => 'Mantenimiento',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 15,
                'nombre' => 'Previas',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 16,
                'nombre' => 'Proyecto',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 17,
                'nombre' => 'Refacciones',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:07',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 18,
                'nombre' => 'Servicio',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:08',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 19,
                'nombre' => 'Sistemas',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:08',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 20,
                'nombre' => 'Tesoreria',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:08',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
            [
                'id_departamento' => 21,
                'nombre' => 'Venta',
                'status' => '1',
                'created_at' => '2024-06-28 05:30:08',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
            ],
        ]);
    }
}
