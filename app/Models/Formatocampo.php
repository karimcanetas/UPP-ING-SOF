<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formatocampo extends Model
{
    protected $connection = 'mysql_2'; // bd vigilancia
    protected $table = 'formato_campo';

    protected $primaryKey = 'id_formatocampo';

    public $timestamps = false;

    protected $fillable = [
        'id_formatos',
        'id_campo'
    ];

    public function formato()
    {
        return $this->belongsTo(Formato::class, 'id_formatos');
    }

    public function campo()
    {
        return $this->belongsTo(Campo::class, 'id_campo');
    }
}
