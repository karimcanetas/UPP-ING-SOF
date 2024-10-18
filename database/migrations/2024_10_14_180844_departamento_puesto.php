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
        Schema::create('departamento_puesto', function (Blueprint $table) {
            $table->id('id');
            $table->integer('id_departamento');
            $table->integer('id_puesto');
            $table->integer('status');

            //clave foranea
            $table->foreign('id_departamento')->references('id_departamento')->on('departamentos')->onDelete('cascade');
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
