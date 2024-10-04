<?php

namespace App\Models;

use illuminate\Database\Eloquent\Factories\HasFactory;
use illuminate\Database\Eloquent\Model;

class Condicionsalida extends Model
{
    use HasFactory;
    protected $connection = 'mysql_2';
    protected $table = 'condicion_salida';
    protected $primaryKey = 'id_condicion';
    protected $fillable = [
        'nombre'
    ];

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_condicion', 'id_condicion');
    }
}
