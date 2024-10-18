<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoAsociado extends Model
{
    use HasFactory;
    protected $connection = 'mysql'; // bd concentradora
    protected $table = 'tipo_asociados';
    protected $primaryKey = "id_tipo_asociado";

    protected $fillable = ['nombre', 'status'];

    public function empleados()
    {
        return $this->hasMany(EmpleadosCatalogo::class, 'id_tipo_asociado', 'id_tipo_asociado');
    }
}
