<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class formatos extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $connection = 'mysql_2'; //bd vigilancia
    public function run(): void
    {
        DB::table('formatos')->insert([
            ['id_formatos' => 1, 'Tipo' => 'Novedades', 'Fecha_de_creacion' => '2024-08-07', 'Ultima_modificacion' => '2024-08-07'],
            ['id_formatos' => 3, 'Tipo' => 'Control de Unidades', 'Fecha_de_creacion' => '2024-08-23', 'Ultima_modificacion' => '2024-08-23'],
            ['id_formatos' => 4, 'Tipo' => 'Control de proveedores TOTs', 'Fecha_de_creacion' => '2024-08-23', 'Ultima_modificacion' => '2024-08-23'],
            ['id_formatos' => 5, 'Tipo' => 'Uso Unidades demos (Pruebas de manejo y/o diligencias)', 'Fecha_de_creacion' => '2024-08-23', 'Ultima_modificacion' => '2024-08-23'],
            ['id_formatos' => 6, 'Tipo' => 'Revision de instalaciones', 'Fecha_de_creacion' => '2024-08-26', 'Ultima_modificacion' => '2024-08-26'],
            ['id_formatos' => 7, 'Tipo' => 'Inventario de unidades en exhibición', 'Fecha_de_creacion' => '2024-08-26', 'Ultima_modificacion' => '2024-08-26'],
            ['id_formatos' => 8, 'Tipo' => 'Control de acceso a proveedores', 'Fecha_de_creacion' => '2024-08-26', 'Ultima_modificacion' => '2024-08-26'],
            ['id_formatos' => 9, 'Tipo' => 'Acceso y salida de unidades siniestradas', 'Fecha_de_creacion' => '2024-08-26', 'Ultima_modificacion' => '2024-08-26'],
            ['id_formatos' => 10, 'Tipo' => 'Entrada y salida de unidades del encierro', 'Fecha_de_creacion' => '2024-08-26', 'Ultima_modificacion' => '2024-08-26'],
            ['id_formatos' => 11, 'Tipo' => 'Inventario de unidades nuevas en encierro / patio', 'Fecha_de_creacion' => '2024-08-26', 'Ultima_modificacion' => '2024-08-26'],
            ['id_formatos' => 12, 'Tipo' => 'Control de aceite y residuos de taller', 'Fecha_de_creacion' => '2024-08-26', 'Ultima_modificacion' => '2024-08-26'],
            ['id_formatos' => 13, 'Tipo' => 'Registro de unidades siniestradas en estacionamiento fuera de horario laboral', 'Fecha_de_creacion' => '2024-08-27', 'Ultima_modificacion' => '2024-08-27'],
            ['id_formatos' => 14, 'Tipo' => 'Registro de unidades seminuevas en estacionamiento para exhibición', 'Fecha_de_creacion' => '2024-08-27', 'Ultima_modificacion' => '2024-08-27'],
            ['id_formatos' => 15, 'Tipo' => 'Registro de otras unidades en estacionamientos de clientes', 'Fecha_de_creacion' => '2024-08-27', 'Ultima_modificacion' => '2024-08-27'],
            ['id_formatos' => 16, 'Tipo' => 'Unidades estadía en taller', 'Fecha_de_creacion' => '2024-08-27', 'Ultima_modificacion' => '2024-08-27'],
            ['id_formatos' => 17, 'Tipo' => 'Control de acceso de unidades por el área de taller postventa', 'Fecha_de_creacion' => '2024-08-27', 'Ultima_modificacion' => '2024-08-27'],
            ['id_formatos' => 18, 'Tipo' => 'Vehículos por siniestros (ORDENES TIPO B SEGUROS)', 'Fecha_de_creacion' => '2024-08-27', 'Ultima_modificacion' => '2024-08-27'],
            ['id_formatos' => 19, 'Tipo' => 'Vehículo para lavado (ORDENES TIPO I,D,A,S Y E INTERNAS Y EMPLEADOS)', 'Fecha_de_creacion' => '2024-08-27', 'Ultima_modificacion' => '2024-08-27'],
            ['id_formatos' => 20, 'Tipo' => 'Unidades estadía en azotea', 'Fecha_de_creacion' => '2024-08-27', 'Ultima_modificacion' => '2024-08-27'],
            ['id_formatos' => 21, 'Tipo' => 'Novedades Servicios', 'Fecha_de_creacion' => '2024-09-03', 'Ultima_modificacion' => '2024-09-03'],
            ['id_formatos' => 22, 'Tipo' => 'Control de entrega de unidades en postventa', 'Fecha_de_creacion' => '2024-09-03', 'Ultima_modificacion' => '2024-09-03'],
            ['id_formatos' => 23, 'Tipo' => 'Salida Unidades TOTs', 'Fecha_de_creacion' => '2024-09-03', 'Ultima_modificacion' => '2024-09-03'],
            ['id_formatos' => 24, 'Tipo' => 'Control de unidades en estacionamiento TOYOTA', 'Fecha_de_creacion' => '2024-09-03', 'Ultima_modificacion' => '2024-09-03'],
            ['id_formatos' => 25, 'Tipo' => 'Control de acceso a proveedores Montejo', 'Fecha_de_creacion' => '2024-09-03', 'Ultima_modificacion' => '2024-09-03'],
            ['id_formatos' => 26, 'Tipo' => 'Control de acceso a proveedores Subaru', 'Fecha_de_creacion' => '2024-09-03', 'Ultima_modificacion' => '2024-09-03'],
            ['id_formatos' => 27, 'Tipo' => 'POSTVENTA - BITACORA DE SURTIDO DE ACEITE BAHIAS', 'Fecha_de_creacion' => '2024-09-03', 'Ultima_modificacion' => '2024-09-03'],
            ['id_formatos' => 29, 'Tipo' => 'POSTVENTA - BITACORA DE ACEITE GRANEL', 'Fecha_de_creacion' => '2024-09-04', 'Ultima_modificacion' => '2024-09-04'],
            ['id_formatos' => 30, 'Tipo' => 'Novedades Subaru', 'Fecha_de_creacion' => '2024-09-04', 'Ultima_modificacion' => '2024-09-04'],
            ['id_formatos' => 31, 'Tipo' => 'Control de entrega de unidades en Postventa', 'Fecha_de_creacion' => '2024-09-04', 'Ultima_modificacion' => '2024-09-04'],
            ['id_formatos' => 32, 'Tipo' => 'SALIDA UNIDADES TOTs SUBARU', 'Fecha_de_creacion' => '2024-09-04', 'Ultima_modificacion' => '2024-09-04'],
            ['id_formatos' => 33, 'Tipo' => 'Control de unidades en estacionamiento SUBARU', 'Fecha_de_creacion' => '2024-09-04', 'Ultima_modificacion' => '2024-09-04'],
            ['id_formatos' => 34, 'Tipo' => 'Control de Unidades del área de demos', 'Fecha_de_creacion' => '2024-09-05', 'Ultima_modificacion' => '2024-09-05'],
            ['id_formatos' => 35, 'Tipo' => 'Registro de Proveedores', 'Fecha_de_creacion' => '2024-09-05', 'Ultima_modificacion' => '2024-09-05'],
            ['id_formatos' => 36, 'Tipo' => 'Checklist de mantenimiento', 'Fecha_de_creacion' => '2024-09-06', 'Ultima_modificacion' => '2024-09-06'],
            ['id_formatos' => 37, 'Tipo' => 'Control de Asistencia', 'Fecha_de_creacion' => '2024-09-06', 'Ultima_modificacion' => '2024-09-06'],
            ['id_formatos' => 38, 'Tipo' => 'Revisión de Herramientas', 'Fecha_de_creacion' => '2024-09-07', 'Ultima_modificacion' => '2024-09-07'],
            ['id_formatos' => 39, 'Tipo' => 'Registro de visitantes', 'Fecha_de_creacion' => '2024-09-08', 'Ultima_modificacion' => '2024-09-08'],
            ['id_formatos' => 40, 'Tipo' => 'Registro de Actividades diarias', 'Fecha_de_creacion' => '2024-09-09', 'Ultima_modificacion' => '2024-09-09'],
            ['id_formatos' => 41, 'Tipo' => 'Registro de cambios en turnos', 'Fecha_de_creacion' => '2024-09-10', 'Ultima_modificacion' => '2024-09-10'],
            ['id_formatos' => 42, 'Tipo' => 'Informe de novedades diarias', 'Fecha_de_creacion' => '2024-09-11', 'Ultima_modificacion' => '2024-09-11'],
            ['id_formatos' => 43, 'Tipo' => 'Control de asignaciones de personal', 'Fecha_de_creacion' => '2024-09-12', 'Ultima_modificacion' => '2024-09-12'],
        ]);
    }
}
