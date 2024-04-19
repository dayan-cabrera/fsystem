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
        Schema::create('casillas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_piso');
            $table->foreign('id_piso')->references('id')->on('pisos')->onDelete('cascade');
            $table->boolean('mant')->default(false);
            $table->boolean('ocupada')->default(false);
            $table->string('fecha_mant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casillas');
    }
};
