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
        Schema::create('turnos', function(Blueprint $table) {
            $table->id('id_turnos');
            $table->string('turnos');
            $table->time('Hora_inicio');
            $table->time('Hora_Fin');
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
