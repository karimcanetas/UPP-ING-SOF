<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;


class Empleados extends Model {

    use HasFactory;

    protected $connection = 'mysql_2';

    protected $primaryKey = 'id_empleado';

    protected $table = 'empleados';

    public $timestamps = false;

    public $guarded = array();

    protected $fillable = ['nombre', /* otros campos */];

    public function user()
    {
        return $this->hasOne(Empleado::class);
    }

}
