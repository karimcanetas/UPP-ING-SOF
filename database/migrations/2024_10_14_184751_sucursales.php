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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id('id_sucursal');
            $table->string('nombre');
            $table->integer('id_empresa');
            $table->timestamp('created_at');
            $table->integer('created_user')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_user')->nullable();
            $table->string('status')->nullable();
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
