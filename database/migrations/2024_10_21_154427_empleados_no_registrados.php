<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $connection = 'mysql_2'; //bd vigilancia 
    public function up(): void
    {   
        Schema::create('empleados_no_registrados', function(Blueprint $table) {
            $table->id('id_empleado');
            $table->string('nombres');
            $table->string('apellido_p');
            $table->string('apellido_m');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
