<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EmpleadosCatalogo extends Model
{
    use HasFactory;
    protected $connection = 'mysql'; //bd Concentradora

    protected $table = 'empleados';

    protected $primaryKey = 'id_empleado';

    protected $fillable = [
        'n_empleado',
        'nombres',
        'apellido_p',
        'apellido_m',
        'fecha_nacimiento',
        'fecha_ingreso',
        'rfc',
        'curp',
        'nss',
        'correo_personal',
        'celular_personal',
        'id_tipo_asociado',
        'id_sucursal_principal',
        'id_puesto',
        'observaciones',
        'fecha_baja',
        'motivo_baja',
        'created_at',
        'created_user',
        'updated_at',
        'updated_user',
        'status'
    ];
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_motivo', 'id_motivo');
    }
    public function tipoAsociado()
    {
        return $this->belongsTo(TipoAsociado::class, 'id_tipo_asociado', 'id_tipo_asociado');
    }
    public function puesto()
    {

        return $this->belongsTo(Puestos::class, 'departamento_puesto', 'id_puesto', 'id_puesto')->withDefault();
    }
    public function puestos()
    {

        return $this->belongsTo(Puestos::class, 'id_puesto', 'id_puesto');
    }

    public function sucursales(): BelongsToMany
    {
        return $this->belongsToMany(Sucursal::class, 'empleado_sucursal', 'id_empleado', 'id_sucursal', 'id_empleado');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'n_empleado', 'n_empleado');
    }
    public function departamentos()
    {
        return $this->belongsToMany(Departamentos::class, 'suc_dep', 'id_empleado', 'id_departamento');
    }
    public function empleadosFormatos()
    {
        return $this->hasMany(EmpleadosFormatos::class, 'id_empleado');
    }
    public function formatos()
    {
        return $this->belongsToMany(Formato::class, 'empleados_formatos', 'id_empleado', 'id_formatos')
            ->withPivot('status')
            ->withTimestamps();
    }
}
