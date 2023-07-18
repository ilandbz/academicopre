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
        Schema::create('programas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('aula_id')->constrained('aulas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('vacantes');
            $table->foreignId('semestre_id')->constrained('semestres')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('es_activo')->unsigned()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programas');
    }
};
