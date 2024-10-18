<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class departamento_puesto extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql'; //bd concentradora
    public function run(): void
    {
        DB::table('departamento_puesto')->insert([
            [
                'id' => 1,
                'id_departamento' => 16,
                'id_puesto' => 1,
                'status' => 1,
            ],
            [
                'id' => 2,
                'id_departamento' => 16,
                'id_puesto' => 2,
                'status' => 1,
            ],
            [
                'id' => 3,
                'id_departamento' => 19,
                'id_puesto' => 3,
                'status' => 1,
            ],
            [
                'id' => 4,
                'id_departamento' => 19,
                'id_puesto' => 4,
                'status' => 1,
            ],
            [
                'id' => 5,
                'id_departamento' => 3,
                'id_puesto' => 5,
                'status' => 1,
            ],
            [
                'id' => 6,
                'id_departamento' => 20,
                'id_puesto' => 6,
                'status' => 1,
            ],
            [
                'id' => 7,
                'id_departamento' => 20,
                'id_puesto' => 7,
                'status' => 1,
            ],
            [
                'id' => 8,
                'id_departamento' => 20,
                'id_puesto' => 8,
                'status' => 1,
            ],
            [
                'id' => 9,
                'id_departamento' => 13,
                'id_puesto' => 9,
                'status' => 1,
            ],
            [
                'id' => 10,
                'id_departamento' => 20,
                'id_puesto' => 10,
                'status' => 1,
            ],
            [
                'id' => 11,
                'id_departamento' => 20,
                'id_puesto' => 11,
                'status' => 1,
            ],
            [
                'id' => 12,
                'id_departamento' => 20,
                'id_puesto' => 12,
                'status' => 1,
            ],
            [
                'id' => 13,
                'id_departamento' => 20,
                'id_puesto' => 13,
                'status' => 1,
            ],
            [
                'id' => 14,
                'id_departamento' => 20,
                'id_puesto' => 14,
                'status' => 1,
            ],
            [
                'id' => 15,
                'id_departamento' => 16,
                'id_puesto' => 15,
                'status' => 1,
            ],
        ]);
    }
}
