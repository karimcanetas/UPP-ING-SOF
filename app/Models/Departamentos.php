<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $connection = 'mysql'; //bd concentradora
    protected $table = 'departamentos';
    protected $primaryKey = 'id_departamento';

    protected $fillable = [
        'nombre',
        'status',
    ];
    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class, 'suc_dep', 'id_sucursal', 'id_departamento')
            ->withTimestamps();
    }
    public function puestos()
    {
        return $this->belongsToMany(Puestos::class, 'departamento_puesto');
    }
    // public function empleados()
    // {
    //     return $this->belongsToMany(EmpleadosCatalogo::class, 'suc_dep', 'id_departamento', 'id_empleado');
    // }
    public function empleados()
    {
        return $this->hasManyThrough(EmpleadosCatalogo::class, Puestos::class);
    }
}
