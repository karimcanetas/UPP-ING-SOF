<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected $connection = 'mysql_2'; // bd vigilancia
    protected $table = 'incidencias';

    protected $primaryKey = 'id_incidencias';

    public $timestamps = false;

    protected $fillable = [
        'id_casetas',
        'Detalles',
        'id_formatos',
        'fecha_hora',
        'guardia',
        'Nombre_vigilante',
        'id_turnos',
        'lt_gasolina_inicial',
        'lt_gasolina_final',
        'folio_Salida_definitiva',
        'id_unidad'
    ];

    // Relaciones
    public function caseta()
    {
        return $this->belongsTo(Caseta::class, 'id_casetas');
    }
    public function formato()
    {
        return $this->belongsTo(Formato::class, 'id_formatos'); //si falla cambiarlo por hasmany pero la consecuencia sera en el metodo de EnvioVigilante no accedera a la propiedad "Tipo"
    }
    public function formatos()
    {
        return $this->hasMany(Formato::class, 'id_formatos');
    }
    public function turnos()
    {
        return $this->belongsTo(Turno::class, 'id_turnos');
    }
    public function turno()
    {
        return $this->belongsTo(Turno::class, 'id_turnos');
    }
    public function campoIncidencias()
    {
        return $this->hasMany(CampoIncidencia::class, 'id_incidencias');
    }

    public function campos()
    {
        return $this->hasMany(CampoIncidencia::class, 'id_incidencias');
    }
    
}
