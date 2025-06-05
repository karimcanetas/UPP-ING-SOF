<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesos extends Model
{
    use HasFactory;

    protected $connection = 'mysql'; // bd concentradora
    protected $table = 'accesos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'url',
        'status',
        'created_at',
        'updated_at',    
    ];    
    
    public function userAccesos()
    {
        return $this->hasMany(UserAccesos::class, 'id_acceso');
    }
}
