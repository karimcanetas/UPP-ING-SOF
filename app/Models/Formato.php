<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Formato extends Model
{
    protected $connection = 'mysql_2'; // bd vigilancia
    protected $table = 'formatos';
    protected $primaryKey = 'id_formatos';

    public $timestamps = false;

    protected $fillable = [
        'Tipo',
        'Fecha_de_creacion',
        'Ultima_modificacion'
    ];

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_formatos', 'id_formatos');
    }

    // Relación de la tabla relacional formato_casetas
    public function casetas()
    {
        return $this->belongsToMany(Caseta::class, 'formato_caseta', 'id_formatos', 'id_casetas')
            ->withPivot('id_turnos');
    }

    public function turnos()
    {
        return $this->belongsToMany(Turno::class, 'formato_caseta', 'id_formatos', 'id_turnos')
            ->withPivot('id_casetas');
    }
    public function campoIncidencias()
    {
        return $this->hasMany(CampoIncidencia::class, 'id_formatos');
    }
    public function empleadosFormatos()
    {
        return $this->hasMany(EmpleadosFormatos::class, 'id_formatos', 'id_formatos');
    }
    public function empleados()
    {
        return $this->belongsToMany(EmpleadosCatalogo::class, 'empleados_formatos', 'id_formato', 'id_empleado')
            ->withPivot('status')
            ->withTimestamps();
    }
}
