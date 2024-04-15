<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ubicacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_casilla');
            $table->foreign('id_casilla')->references('id')->on('casillas')->onDelete('cascade');
            $table->unsignedBigInteger('id_carga');
            $table->foreign('id_carga')->references('id')->on('cargas')->onDelete('cascade');
            $table->string('fecha_salida');
            $table->string('fecha_salida_real');
            $table->string('fecha_entrada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicacions');
    }
};
