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
        Schema::create('viviendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('direccion');
            $table->decimal('precio', 11, 2)->unsigned()->nullable(); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viviendas');
    }
};
