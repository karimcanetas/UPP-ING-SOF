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
        'Hora_inicio',
        'Hora_Fin',
    ];


    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_turnos', 'id_turnos');
    }
}
