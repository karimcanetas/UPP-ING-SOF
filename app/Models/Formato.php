<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formato extends Model
{
    protected $connection = 'mysql_2'; // bd vigilancia
    protected $table = 'formatos';
    protected $primaryKey = 'id_formatos';

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
        return $this->belongsToMany(Caseta::class, 'formato_caseta', 'id_formatos', 'id_casetas');
    }

    public function turnos()
    {
        return $this->belongsToMany(Turno::class, 'id_turnos', 'turno', 'Hora_inicio', 'Hora_Fin');
    }
}
