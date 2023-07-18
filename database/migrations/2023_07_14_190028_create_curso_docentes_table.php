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
        Schema::create('curso_docentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('docente_id')->constrained('docentes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('programa_id')->constrained('programas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('semestre_id')->constrained('semestres')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_docentes');
    }
};
