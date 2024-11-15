<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Sucursal extends Model
{
    protected $connection = 'mysql'; // bd concentradora
    protected $table = 'sucursales';
    protected $primaryKey = 'id_sucursal';

    protected $fillable = ['nombre', 'id_empresa', 'status'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id_empresa');
    }

    // Relación con el modelo Caseta
    public function casetas(): HasMany
    {
        return $this->hasMany(Caseta::class, 'id_sucursal', 'id_sucursal');
    }

    //tabla pivote departamentos
    public function departamentos()
    {
        return $this->belongsToMany(Departamentos::class, 'suc_dep', 'id_sucursal', 'id_departamento')
            ->withTimestamps();
    }   

    public function empleados()
    {
        return $this->belongsToMany(EmpleadosCatalogo::class, 'empleado_sucursal', 'id_sucursal', 'id_empleado')
            ->withPivot('id_sucursal');
    }
}
