<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadosNoRegistrados extends Model
{
    use HasFactory;

    protected $connection = 'mysql_2';

    protected $table = 'empleados_no_registrados';

    protected $primaryKey = 'id_empleado';
    protected $fillable = [
        'nombres',
        'apellido_p',
        'apellido_m',
        'puesto',
        'tipo_asociado,'
    ];
}
