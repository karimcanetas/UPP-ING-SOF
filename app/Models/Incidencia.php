<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected $connection = 'mysql_2'; // bd vigilancia
    protected $table = 'incidencias';

    protected $primaryKey = 'id_incidencias'; 

    public $timestamps = false; 

        protected $fillable = [
            'id_casetas',
            'Detalles',
            'id_formatos',
            'fecha_hora',
            'guardia',
            'Nombre_vigilante',
            'id_turnos',
    ];

    // Relaciones
    public function caseta()
    {
        return $this->belongsTo(Caseta::class, 'id_casetas');
    }

}
