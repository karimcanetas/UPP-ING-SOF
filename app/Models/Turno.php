<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $connection = 'mysql_2'; //bd vigilancia
    protected $table = 'turnos';
    protected $primaryKey = 'id_turnos';
    protected $fillable = [
        'turno',
        'id_sucursal',
        'Hora_inicio',
        'Hora_Fin',
    ];


    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_turnos', 'id_turnos');
    }

    public function casetas()
    {
        return $this->belongsToMany(Caseta::class, 'formato_caseta', 'id_turnos', 'id_casetas')
            ->withPivot('id_formatos');
    }

    public function formatos()
    {
        return $this->belongsToMany(Formato::class, 'formato_caseta', 'id_turnos', 'id_formatos')
            ->withPivot('id_casetas');
    }
    //turno por sucursal
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'id_sucursal', 'id_sucursal');
    }
}
