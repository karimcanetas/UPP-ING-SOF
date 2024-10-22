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
        Schema::create('campo_incidencias', function (Blueprint $table) {
            $table->id('id_campo_incidencias');
            $table->unsignedBigInteger('id_incidencias');
            $table->unsignedBigInteger('id_campo');
            $table->unsignedBigInteger('id_formatos');
            $table->integer('valor')->nullable();
    
            //claves foraneas
            $table->foreign('id_incidencias')->references('id_incidencias')->on('incidencias')->onDelete('cascade');
            $table->foreign('id_campo')->references('id_campo')->on('campos')->onDelete('cascade');
            $table->foreign('id_formatos')->references('id_formatos')->on('formatos')->onDelete('cascade');
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
