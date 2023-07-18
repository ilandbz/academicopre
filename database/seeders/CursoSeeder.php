<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Curso::firstOrCreate([
            'codigo'       => 'LP3CC',
            'nombres'       => 'LENGUAJE DE PROGRAMACION',
            'credito'       =>  5,
            'estado'        => 'LIBRE',
            'tipo'         => 'SEMESTRAL',
            'estadodocente'  => 'PENDIENTE'
        ]);
    }
}
