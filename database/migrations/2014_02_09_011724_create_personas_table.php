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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8)->unique();
            $table->string('nombres', 90);
            $table->string('apellidop', 120);
            $table->string('apellidom', 120);
            $table->date('fnacimiento')->default('1995-01-01');
            $table->string('email')->unique();
            $table->string('direccion')->nullable();
            $table->string('celular')->nullable();
            $table->char('sexo',1)->default('M');
            $table->string('foto', 80)->default('default.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
