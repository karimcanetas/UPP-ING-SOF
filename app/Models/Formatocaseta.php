<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Formatocaseta extends Model
{
    protected $connection = 'mysql_2'; //bd vigilancia
    protected $table = 'formato_caseta';
    protected $primaryKey = 'id_formatocaseta';

    protected $fillable = ['id_casetas', 'id_formatos'];

    // Relación con el modelo caseta
    public function Caseta(): BelongsTo
    {
        return $this->belongsTo(Caseta::class, 'id_casetas', 'id_casetas');
    }

    // Relación con el modelo formato
    public function Formato(): BelongsTo
    {
        return $this->belongsTo(Formato::class, 'id_formatos', 'id_formatos');
    }

    public function Turnos()
    {
        return $this->belongsToMany(Turno::class, 'id_turnos', 'turno', 'Hora_inicio', 'Hora_Fin');
    }
}
