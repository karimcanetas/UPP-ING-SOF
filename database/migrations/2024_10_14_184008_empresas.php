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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id('id_empresa');
            $table->string('nombre')->nullable();
            $table->string('rfc')->nullable();
            $table->string('alias')->nullable();
            $table->timestamp('created_at');
            $table->integer('created_user')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_user')->nullable();
            $table->string('status');
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
