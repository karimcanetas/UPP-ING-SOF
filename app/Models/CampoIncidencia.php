<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampoIncidencia extends Model
{
    use HasFactory;

    protected $connection = 'mysql_2'; // Base de datos vigilancia
    protected $table = 'campo_incidencias';
    protected $primaryKey = 'id_campo_incidencias';
    public $timestamps = false;

    protected $fillable = ['id_incidencias', 'id_campo', 'id_formatos', 'valor'];

    // Relación con Incidencia
    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class, 'id_incidencias');
    }

    // Relación con Campo
    public function campo()
    {
        return $this->belongsTo(Campo::class, 'id_campo');
    }

    // Relación con Formato
    public function formato()
    {
        return $this->belongsTo(Formato::class, 'id_formatos');
    }
}
    