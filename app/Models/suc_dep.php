<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class suc_dep extends Model
{
    protected $connection = 'mysql'; //bd concentradora
    protected $table = 'suc_dep';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_sucursal',
        'id_departamento'
    ];

    public function sucursales()
    {
        return $this->belongsTo(Sucursal::class, 'id_sucursal');
    }

    public function departamentos()
    {
        return $this->belongsTo(Departamentos::class, 'id_departamento');
    }
}
