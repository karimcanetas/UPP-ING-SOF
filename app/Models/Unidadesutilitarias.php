<?php  

namespace App\Models;

use illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidadesutilitarias extends Model
{
    use HasFactory;

    protected $connection = 'mysql_2'; //bd vigilancia
    protected $table = 'unidades_utilitarias';
    protected $primaryKey = 'id_unidadut';
    protected $fillable = [
        'nombre'
    ];

    public function incidencias() 
    {
        return $this->hasMany(Incidencia::class, 'id_unidadut', 'id_unidadut');
    }
}