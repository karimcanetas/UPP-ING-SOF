<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plataforma extends Model
{
    use HasFactory;

    protected $connection = 'mysql'; // bd concentradora
    protected $table = 'plataformas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'url',
        'publica',
        'status',
        'created_at',
        'updated_at'
    ];
    public function usersPlataformas()
    {
        return $this->hasMany(UsersPlataformas::class, 'id_plataforma', 'id');
    }
    public function scopeActivas($query)
    {
        return $query->where('status', true);
    }
    public function scopePublicas($query)
    {
        return $query->where('publica', true);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_plataformas', 'id_plataforma', 'id_user');
    }
}
