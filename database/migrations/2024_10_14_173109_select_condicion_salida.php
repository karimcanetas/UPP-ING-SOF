<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    // dentro del schema connection('mysql_2')->create
    protected $connection = 'mysql_2'; //bd vigilancia
    public function up(): void
    {
        Schema::create ('condicion_salida', function (Blueprint $table) {
            $table->id('id_condicion');
            $table->string('nombre');
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
