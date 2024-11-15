<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EmpleadoSucursal extends Model
{
    protected $connection = 'mysql'; //bd concentradora
    protected $table = 'empleado_sucursal';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_empleado',
        'id_sucursal'
    ];
    public function empleados(): BelongsToMany
    {
        return $this->belongsToMany(EmpleadosCatalogo::class, 'empleado_sucursal', 'id_sucursal', 'id_empleado');
    }
}
