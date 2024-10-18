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
        Schema::create('tipo_asociados', function(Blueprint $table) {
            $table->id('id_tipo_asociado');
            $table->string('nombre');
            $table->integer('status');
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
