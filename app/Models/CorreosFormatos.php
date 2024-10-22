<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorreosFormatos extends Model
{
    use HasFactory;
    protected $connection = 'mysql_2';
    protected $table = 'correos_formatos';
    protected $primaryKey = 'id_correo_formato';
    public $timestamps = false;
    protected $fillable = [
        'id_correo',
        'id_formatos'
    ];

    public function correo()
    {
        return $this->belongsTo(Correos::class, 'id_correo', 'id_correo');
    }

    public function formato()
    {
        return $this->belongsTo(Formato::class, 'id_formatos', 'id_formatos');
    }
}
