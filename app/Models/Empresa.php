<?php

namespace App\Models;

use Database\Seeders\casetas;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $connection ='mysql'; //bd Concentradora
    protected $table = 'empresas';
    protected $primaryKey = 'id_empresa';

    protected $fillable = ['nombre', 'rfc', 'alias',];

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class, 'id_empresa', 'id_empresa');
    }
    public function casetas() {
        return $this->hasMany(Caseta::class, 'id_empresa', 'id_empresa');
    }
}
