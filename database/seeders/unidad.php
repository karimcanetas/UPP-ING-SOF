<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class unidad extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql_2';
    public function run(): void
    {
        DB::table('unidad')->insert([
            ['id_unidad' => 1, 'unidad' => 'AVANZA'],
            ['id_unidad' => 2, 'unidad' => 'CH-R'],
            ['id_unidad' => 3, 'unidad' => 'CAMRY'],
            ['id_unidad' => 4, 'unidad' => 'COROLLA'],
            ['id_unidad' => 5, 'unidad' => 'HIACE'],
            ['id_unidad' => 6, 'unidad' => 'FJ CRUISER'],
            ['id_unidad' => 7, 'unidad' => 'HIGHLANDER'],
            ['id_unidad' => 8, 'unidad' => 'HILUX'],
            ['id_unidad' => 9, 'unidad' => 'RAV4'],
            ['id_unidad' => 10, 'unidad' => 'MARIX'],
            ['id_unidad' => 11, 'unidad' => 'SEQUOIA'],
            ['id_unidad' => 12, 'unidad' => 'SIENNA'],
            ['id_unidad' => 13, 'unidad' => 'TACOMA'],
            ['id_unidad' => 14, 'unidad' => 'TUNDRA'],
            ['id_unidad' => 15, 'unidad' => 'YARIS'],
            ['id_unidad' => 16, 'unidad' => 'LAND CRUISER']
        ]);
    }
}
