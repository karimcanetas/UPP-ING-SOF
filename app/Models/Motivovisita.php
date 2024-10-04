<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivovisita extends Model
{
    use HasFactory;
    protected $connection = 'mysql_2'; //bd vigilancia
    protected $table = 'motivo_visita';
    protected $primaryKey = 'id_motivo';
    protected $fillable = [
        'nombre'
    ];

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_motivo', 'id_motivo');
    }
}