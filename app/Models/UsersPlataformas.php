<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersPlataformas extends Model
{
    use HasFactory;

    protected $connection = 'mysql'; // bd concentradora
    protected $table = 'users_plataformas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'id_plataforma',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function plataforma()
    {
        return $this->belongsTo(Plataforma::class, 'id_plataforma');
    }
}
