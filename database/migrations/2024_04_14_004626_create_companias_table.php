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
        Schema::create('companias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipocomp');
            $table->foreign('id_tipocomp')->references('id')->on('tipo_companias')->onDelete('cascade');
            $table->unsignedBigInteger('id_seguridad');
            $table->foreign('id_seguridad')->references('id')->on('seguridads')->onDelete('cascade');
            $table->unsignedBigInteger('id_condalm');
            $table->foreign('id_condalm')->references('id')->on('cond_alms')->onDelete('cascade');
            $table->unsignedBigInteger('id_prioridad');
            $table->foreign('id_prioridad')->references('id')->on('prioridads')->onDelete('cascade');
            $table->unsignedBigInteger('id_empresa');
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
            $table->string('nombre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companias');
    }
};
