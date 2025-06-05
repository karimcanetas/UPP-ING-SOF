<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccesos extends Model
{
    use HasFactory;

    protected $connection = 'mysql'; // bd concentradora
    protected $table = 'users_accesos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'id_acceso',
        'usuario',
        'password',    
    ];

    public function acceso()
    {
        return $this->belongsTo(Accesos::class, 'id_acceso');
    }
}
