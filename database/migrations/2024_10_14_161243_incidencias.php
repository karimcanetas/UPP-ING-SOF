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
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id('id_incidencias');
            $table->unsignedBigInteger('id_casetas');
            $table->unsignedBigInteger('id_formatos');
            $table->unsignedBigInteger('id_turnos');
            $table->string('Nombre_vigilante');
            $table->string('guardia')->nullable();
            $table->dateTime('fecha_hora');
            $table->integer('enviado')->nullable();

            // claves foranea
            $table->foreign('id_casetas')->references('id_casetas')->on('casetas')->onDelete('cascade');
            $table->foreign('id_formatos')->references('id_formatos')->on('formatos')->onDelete('cascade');
            $table->foreign('id_turnos')->references('id_turnos')->on('turnos')->onDelete('cascade');
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
