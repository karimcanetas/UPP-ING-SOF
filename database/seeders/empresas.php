<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class empresas extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql'; //bd concentradora
    public function run(): void
    {
        DB::table('empresas')->insert([
            [
                'id_empresa' => 1,
                'nombre' => 'Automotriz Toy del Sureste',
                'rfc' => null,
                'alias' => 'Toyota',
                'created_at' => '2024-06-28 02:49:50',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_empresa' => 2,
                'nombre' => 'Arrendadora Toy del Sureste',
                'rfc' => null,
                'alias' => 'Lyzto',
                'created_at' => '2024-06-28 02:50:04',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
            [
                'id_empresa' => 3,
                'nombre' => 'Promotora e impulsora JAR',
                'rfc' => null,
                'alias' => 'Subaru',
                'created_at' => '2024-06-28 04:42:43',
                'created_user' => null,
                'updated_at' => null,
                'updated_user' => null,
                'status' => 1,
            ],
        ]);
    }
}
