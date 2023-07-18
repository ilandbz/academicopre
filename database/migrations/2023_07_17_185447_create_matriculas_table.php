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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');
            $table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('semestre_id')->constrained('semestres')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('programa_id')->constrained('programas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('observacion')->nullable();
            $table->string('pagomatricula');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
