<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'id_empresa';

    protected $fillable = ['nombre', 'rfc', 'alias',]; 

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class, 'id_empresa', 'id_empresa');
    }
}
