<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $connection = 'mysql'; //bd concentradora
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->string('n_empleado');
            $table->string('nombres')->nullable();
            $table->string('apellido_p')->nullable();
            $table->string('apellido_m')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->string('rfc')->nullable();
            $table->string('curp')->nullable();
            $table->string('nss')->nullable();
            $table->string('correo_personal')->nullable();
            $table->string('celular_personal')->nullable();
            $table->integer('id_tipo_asociado');
            $table->integer('id_puesto');
            $table->string('observaciones')->nullable();
            $table->date('fecha_baja')->nullable();
            $table->string('motivo_baja')->nullable();
            $table->timestamp('created_at');
            $table->integer('created_user')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_user')->nullable();
            $table->integer('status')->nullable();

            //clave foranea
            $table->foreign('id_tipo_asociado')->references('id_tipo_asociado')->on('tipo_asociados')->onDelete('cascade');
            $table->foreign('id_puesto')->references('id_puesto')->on('puestos')->onDelete('cascade');
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
