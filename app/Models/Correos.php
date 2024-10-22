<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correos extends Model
{
    use HasFactory;

    protected $connection = 'mysql_2'; //bd vigilancia
    protected $table = 'correos';
    protected $primaryKey = 'id_correo';
    public $timestamps = false;

    protected $fillable = [
        'id_empleado',
        'correo'
    ];

    public function empleados()
    {
        return $this->belongsTo(EmpleadosCatalogo::class, 'id_empleado', 'id_empleado');
    }

    public function formatos()
    {
        return $this->belongsToMany(Formato::class, 'correos_formatos', 'id_correo', 'id_formatos');
    }
}
