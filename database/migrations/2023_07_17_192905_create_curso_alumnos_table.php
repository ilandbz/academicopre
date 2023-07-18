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
        Schema::create('curso_alumnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('alumno_id')->constrained('alumnos')->onDelete('cascade')->onUpdate('cascade');
            $table->string('estado');
            $table->decimal('TA1',5,2);
            $table->decimal('TA2',5,2);
            $table->decimal('TA3',5,2);
            $table->decimal('TA4',5,2);
            $table->decimal('EP',5,2);
            $table->decimal('EF',5,2);
            $table->decimal('ES',5,2);
            $table->decimal('notaFinal',5,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_alumnos');
    }
};
