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
        Schema::create('trazabilidad_estados', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('tasacion_id')->constrained('tasacions')->onDelete('cascade');
            $table->set('estado', ['Solicitado', 'En proceso', 'Completado', 'Rechazado'])->default('Solicitado');

            // FK User (gestor)
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trazabilidad_estados');
    }
};
