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
        Schema::create('suc_dep', function (Blueprint $table) {
            $table->id('id');
            $table->integer('id_sucursal');
            $table->integer('id_departamento');
            $table->string('status');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();

            //clave foranea
            $table->foreign('id_sucursal')->references('id_sucursal')->on('sucursales')->onDelete('cascade');
            $table->foreign('id_departamento')->references('id_departamento')->on('departamentos')->onDelete('cascade');    
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
