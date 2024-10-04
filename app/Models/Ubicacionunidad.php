<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ubicacionunidad extends Model
{
    use HasFactory;
    protected $connection = 'mysql_2'; //bd vigilancia 
    protected $table = 'ubicacion_unidad';
    protected $primaryKey = 'id_ubiunidad';
    protected $fillable = [
        'nombre'
    ];

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_ubiunidad', 'id_ubiunidad');
    }
}
