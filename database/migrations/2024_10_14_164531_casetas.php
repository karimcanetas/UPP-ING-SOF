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
        Schema::create('casetas', function (Blueprint $table) {
            $table->id('id_casetas');
            $table->foreignId('id_sucursal')->index();
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
