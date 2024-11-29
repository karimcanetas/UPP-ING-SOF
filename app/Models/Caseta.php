<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Caseta extends Model
{
    protected $connection = 'mysql_2'; //bd vigilancia
    protected $table = 'casetas';
    protected $primaryKey = 'id_casetas';

    protected $fillable = ['id_sucursal', 'nombre', 'status'];

    // Relación con el modelo Sucursal
    public function sucursal(): BelongsTo
    {
        return $this->belongsTo(Sucursal::class, 'id_sucursal', 'id_sucursal');
    }

    //Realacion de empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id');
    }

    // Relación de la tabla relacional formato_casetas

    public function formatos()
    {
        return $this->belongsToMany(Formato::class, 'formato_caseta', 'id_casetas', 'id_formatos')
            ->withPivot('id_turnos');
    }

    public function turnos()
    {
        return $this->belongsToMany(Turno::class, 'formato_caseta', 'id_casetas', 'id_turnos')
            ->withPivot('id_formatos');
    }
    public function formatocasetas()
    {
        return $this->hasMany(Formatocaseta::class, 'id_caseta', 'id');
    }
}
