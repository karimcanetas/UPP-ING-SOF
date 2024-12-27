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
        'id_puesto',
        'tipo_asociado,'
    ];
    public function puesto()
    {
        return $this->belongsTo(Puestos::class, 'id_puesto');
    }
}
