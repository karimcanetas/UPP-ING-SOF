<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
