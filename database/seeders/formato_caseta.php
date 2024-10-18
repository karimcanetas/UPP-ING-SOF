<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class formato_caseta extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('formato_caseta')->insert([
            ['id_formatocaseta' => 3, 'id_casetas' => 3, 'id_formatos' => 1, 'id_turnos' => 1],
            ['id_formatocaseta' => 4, 'id_casetas' => 3, 'id_formatos' => 3, 'id_turnos' => 1],
            ['id_formatocaseta' => 7, 'id_casetas' => 3, 'id_formatos' => 4, 'id_turnos' => 1],
            ['id_formatocaseta' => 8, 'id_casetas' => 3, 'id_formatos' => 5, 'id_turnos' => 1],
            ['id_formatocaseta' => 9, 'id_casetas' => 3, 'id_formatos' => 6, 'id_turnos' => 2],
            ['id_formatocaseta' => 10, 'id_casetas' => 3, 'id_formatos' => 7, 'id_turnos' => 2],
            ['id_formatocaseta' => 11, 'id_casetas' => 3, 'id_formatos' => 8, 'id_turnos' => 2],
            ['id_formatocaseta' => 12, 'id_casetas' => 9, 'id_formatos' => 40, 'id_turnos' => 2],
            ['id_formatocaseta' => 13, 'id_casetas' => 9, 'id_formatos' => 9, 'id_turnos' => 1],
            ['id_formatocaseta' => 14, 'id_casetas' => 9, 'id_formatos' => 10, 'id_turnos' => 1],
            ['id_formatocaseta' => 15, 'id_casetas' => 9, 'id_formatos' => 11, 'id_turnos' => 2],
            ['id_formatocaseta' => 16, 'id_casetas' => 16, 'id_formatos' => 12, 'id_turnos' => 2],
            ['id_formatocaseta' => 17, 'id_casetas' => 16, 'id_formatos' => 13, 'id_turnos' => 2],
            ['id_formatocaseta' => 18, 'id_casetas' => 16, 'id_formatos' => 14, 'id_turnos' => 2],
            ['id_formatocaseta' => 19, 'id_casetas' => 16, 'id_formatos' => 15, 'id_turnos' => 2],
            ['id_formatocaseta' => 20, 'id_casetas' => 16, 'id_formatos' => 16, 'id_turnos' => 2],
            ['id_formatocaseta' => 21, 'id_casetas' => 16, 'id_formatos' => 20, 'id_turnos' => 2],
            ['id_formatocaseta' => 22, 'id_casetas' => 16, 'id_formatos' => 17, 'id_turnos' => 1],
            ['id_formatocaseta' => 23, 'id_casetas' => 16, 'id_formatos' => 18, 'id_turnos' => 1],
            ['id_formatocaseta' => 24, 'id_casetas' => 16, 'id_formatos' => 19, 'id_turnos' => 1],
            ['id_formatocaseta' => 30, 'id_casetas' => 1, 'id_formatos' => 21, 'id_turnos' => null],
            ['id_formatocaseta' => 31, 'id_casetas' => 1, 'id_formatos' => 22, 'id_turnos' => 2],
            ['id_formatocaseta' => 32, 'id_casetas' => 7, 'id_formatos' => 23, 'id_turnos' => 1],
            ['id_formatocaseta' => 33, 'id_casetas' => 1, 'id_formatos' => 24, 'id_turnos' => 2],
            ['id_formatocaseta' => 34, 'id_casetas' => 1, 'id_formatos' => 25, 'id_turnos' => 1],
            ['id_formatocaseta' => 38, 'id_casetas' => 7, 'id_formatos' => 26, 'id_turnos' => 1],
            ['id_formatocaseta' => 39, 'id_casetas' => 1, 'id_formatos' => 27, 'id_turnos' => 2],
            ['id_formatocaseta' => 42, 'id_casetas' => 1, 'id_formatos' => 29, 'id_turnos' => 2],
            ['id_formatocaseta' => 44, 'id_casetas' => 5, 'id_formatos' => 30, 'id_turnos' => null],
            ['id_formatocaseta' => 45, 'id_casetas' => 5, 'id_formatos' => 39, 'id_turnos' => 1],
            ['id_formatocaseta' => 46, 'id_casetas' => 5, 'id_formatos' => 32, 'id_turnos' => 1],
            ['id_formatocaseta' => 47, 'id_casetas' => 5, 'id_formatos' => 33, 'id_turnos' => 2],
            ['id_formatocaseta' => 48, 'id_casetas' => 2, 'id_formatos' => 21, 'id_turnos' => null],
            ['id_formatocaseta' => 49, 'id_casetas' => 8, 'id_formatos' => 42, 'id_turnos' => null],
            ['id_formatocaseta' => 50, 'id_casetas' => 8, 'id_formatos' => 34, 'id_turnos' => null],
            ['id_formatocaseta' => 51, 'id_casetas' => 2, 'id_formatos' => 35, 'id_turnos' => 2],
            ['id_formatocaseta' => 52, 'id_casetas' => 8, 'id_formatos' => 35, 'id_turnos' => 2],
            ['id_formatocaseta' => 53, 'id_casetas' => 8, 'id_formatos' => 36, 'id_turnos' => 1],
            ['id_formatocaseta' => 54, 'id_casetas' => 2, 'id_formatos' => 43, 'id_turnos' => null],
            ['id_formatocaseta' => 55, 'id_casetas' => 2, 'id_formatos' => 37, 'id_turnos' => 1],
            ['id_formatocaseta' => 56, 'id_casetas' => 2, 'id_formatos' => 22, 'id_turnos' => 1],
            ['id_formatocaseta' => 57, 'id_casetas' => 8, 'id_formatos' => 38, 'id_turnos' => 1],
            ['id_formatocaseta' => 58, 'id_casetas' => 7, 'id_formatos' => 30, 'id_turnos' => null],
            ['id_formatocaseta' => 59, 'id_casetas' => 16, 'id_formatos' => 41, 'id_turnos' => 1],
        ]);
    }
}
