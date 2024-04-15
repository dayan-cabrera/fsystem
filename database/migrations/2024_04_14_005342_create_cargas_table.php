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
        Schema::create('cargas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('fechaexp');
            $table->decimal('peso');
            $table->boolean('condrefrig');
            $table->unsignedBigInteger('id_tipoprod');
            $table->foreign('id_tipoprod')->references('id')->on('tipo_productos')->onDelete('cascade');
            $table->unsignedBigInteger('id_empaquetado');
            $table->foreign('id_empaquetado')->references('id')->on('tipo_empaquetados')->onDelete('cascade');
            $table->unsignedBigInteger('id_compania');
            $table->foreign('id_compania')->references('id')->on('companias')->onDelete('cascade');
            $table->unsignedBigInteger('id_casilla');
            $table->foreign('id_casilla')->references('id')->on('casillas')->onDelete('cascade');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargas');
    }
};
