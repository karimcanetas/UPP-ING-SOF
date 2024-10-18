<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puestos extends Model
{
    use HasFactory;

    protected $table = 'puestos';

    protected $primaryKey = 'id_puesto';

    protected $fillable = [
        'nombre',
        'id_nivel',
        'created_at',
        'created_user',
        'updated_at',
        'status'
    ];

    public function setConnectionDynamic($connection)
    {
        $this->setConnection($connection);
    }
}
