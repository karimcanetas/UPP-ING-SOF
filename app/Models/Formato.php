<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formato extends Model
{
    protected $connection = 'mysql_2'; // bd vigilancia
    // Especifica el nombre de la tabla asociada
    protected $table = 'formatos';

    // Especifica el nombre de la clave primaria
    protected $primaryKey = 'id_formatos';

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'Tipo',
        'Fecha_de_creacion', 
        'Ultima_modificacion'];

    // Desactiva las marcas de tiempo automáticas (created_at, updated_at)
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_formatos', 'id_formatos');
    }
}


