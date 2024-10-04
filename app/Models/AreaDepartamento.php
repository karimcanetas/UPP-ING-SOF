<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaDepartamento extends Model
 {
    use HasFactory;

    protected $connection = 'mysql_2'; //bd vigilancia
    protected $table = 'area_departamento';
    protected $primaryKey = 'id_areadep';
    protected $fillable = [
        'nombre',
    ];

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_areadep', 'id_areadep');
    }
 }