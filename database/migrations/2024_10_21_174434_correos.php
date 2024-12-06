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
    //     Schema::create('correos', function(Blueprint $table) {
    //         $table->id('id_correo');
    //         $table->unsignedBigInteger('id_empleado');
    //         $table->string('correo');
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
