<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Empleados;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';

    // protected $connection = 'mysql_2';

    protected $fillable = [
        'perfil',
        'n_empleado',
        'email',
        'password',
        'estatus',
    ];

    public $timestamps = false;

    protected $hidden = [
        'password'
    ];

    public function empleado()
    {
        return $this->belongsTo(EmpleadosCatalogo::class, 'n_empleado', 'n_empleado');
    }

    public function plataformas()
    {
        return $this->belongsToMany(Plataforma::class, 'users_plataformas', 'id_user', 'id_plataforma');
    }

}