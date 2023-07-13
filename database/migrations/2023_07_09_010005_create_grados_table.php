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
        Schema::create('grados', function (Blueprint $table) {
            $table->id();
            $table->string('gradonombre');
            $table->tinyInteger('es_activo')->unsigned()->default(1);
            $table->foreignId('aula_id')->constrained('aulas')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('cantidadalumnos');
            $table->foreignId('semestre_id')->constrained('semestres')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grados');
    }
};
