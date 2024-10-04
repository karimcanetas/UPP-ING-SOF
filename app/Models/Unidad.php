<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $connection = 'mysql_2'; //bd vigilancia
    protected $table = 'unidad';
    protected $primaryKey = 'id_unidad';
    protected $fillable = [
        'unidad',
    ];


    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_unidad', 'id_unidad');
    }
}
