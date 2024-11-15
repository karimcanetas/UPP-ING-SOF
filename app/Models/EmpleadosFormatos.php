<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmpleadosFormatos extends Model
{
    protected $connection = 'mysql_2';
    protected $table = 'empleados_formatos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_formatos',
        'id_empleado'
    ];
    public function formato()
    {
        return $this->belongsTo(Formato::class, 'id_formatos', 'id_formatos');
    }
    public function empleado(): BelongsTo
    {
        return $this->belongsTo(EmpleadosCatalogo::class, 'id_empleado', 'id_empleado');
    }
}
