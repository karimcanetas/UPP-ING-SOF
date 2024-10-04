<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    use HasFactory;
    protected $connection = 'mysql_2'; //bd vigilancia
    protected $table = 'campos';
    protected $primaryKey = 'id_campo';
    public $timestamps = false;
    protected $fillable = [
        'campo',
        'tipo'
    ];

    public function formatos()
    {
        return $this->belongsToMany(Formato::class, 'formato_campo', 'id_campo', 'id_formatos');
    }
}
