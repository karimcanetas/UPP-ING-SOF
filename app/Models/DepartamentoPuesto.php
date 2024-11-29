<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartamentoPuesto extends Model
{
    protected $connection = 'mysql'; //bd concentradora
    protected $table = 'departamento_puesto';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_departamento',
        'id_puesto',
        'status',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'id_departamento', 'id_departamento');
    }
    public function puesto() {
        return $this->belongsTo(Puestos::class, 'id_puesto', 'id_puesto');
    }
}
