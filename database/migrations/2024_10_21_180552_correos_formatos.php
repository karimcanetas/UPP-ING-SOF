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
    // public function up(): void
    // {
    //     Schema::create('correos_formatos', function(Blueprint $table) {
    //         $table->id('id_correo_formato');
    //         $table->unsignedBigInteger('id_correo');
    //         $table->unsignedBigInteger('id_formatos');
            
    //         //claves foraneas
    //         $table->foreign('id_correo')->references('id_correo')->on('correos')->onDelete('cascade');
    //         $table->foreign('id_formatos')->references('id_formatos')->on('formatos')->onDelete('cascade');
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
