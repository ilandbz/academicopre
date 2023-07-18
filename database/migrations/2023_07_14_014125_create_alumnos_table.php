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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->foreignId('persona_id')->constrained('personas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('programa_id')->constrained('programas')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('es_activo')->unsigned()->default(1);
            $table->string('estado')->default('PENDIENTE');
            $table->string('estadoPago')->default('PENDIENTE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
