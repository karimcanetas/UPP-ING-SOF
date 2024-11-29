<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class empleado_sucursal extends Model
{
    protected $connection = 'mysql'; //bd concentradora

    protected $table = 'empleado_sucursal';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_empleado',
        'id_sucursal'
    ];

    public function empleado()
    {
        return $this->belongsTo(EmpleadosCatalogo::class, 'id_empleado');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'id_sucursal');
    }
}
