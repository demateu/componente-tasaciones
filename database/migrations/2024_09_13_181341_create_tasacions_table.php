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
        Schema::create('tasacions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('comentarios')->nullable();
            $table->set('estado', ['Solicitado', 'En proceso', 'Completado', 'Rechazado'])->default('Solicitado');

            //FK PARA USER (cliente y gestor)
                // si se elimina el cliente, la tasacion también
            $table->bigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
                // contemplo nullable por si el gestor deja de trabajar
            $table->bigInteger('gestor_id')->unsigned()->nullable();
            $table->foreign('gestor_id')->references('id')->on('users')->onDelete('set null');

            //FK PARA VIVIENDA
                // si se elimina la vivienda, la tasacion también
            $table->bigInteger('vivienda_id')->unsigned();
            $table->foreign('vivienda_id')->references('id')->on('viviendas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasacions');
    }
};
