<?php

namespace Database\Seeders;

use App\Models\Aula;
use App\Models\Programa;
use App\Models\Semestre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Programa::firstOrCreate([
            'nombre'       => 'Computacion',
            'aula_id'      => Aula::where('nombre', 'AULA 01')->value('id'),
            'vacantes'     => 60,
            'semestre_id'  => Semestre::where('nombre', '2023-2')->value('id')
        ]);
        Programa::firstOrCreate([
            'nombre'       => 'Secretariado',
            'aula_id'      => Aula::where('nombre', 'AULA 01')->value('id'),
            'vacantes'     => 60,
            'semestre_id'  => Semestre::where('nombre', '2023-2')->value('id')
        ]);
        Programa::firstOrCreate([
            'nombre'       => 'Agronomia',
            'aula_id'      => Aula::where('nombre', 'AULA 01')->value('id'),
            'vacantes'     => 60,
            'semestre_id'  => Semestre::where('nombre', '2023-2')->value('id')
        ]);
        Programa::firstOrCreate([
            'nombre'       => 'Farmacia',
            'aula_id'      => Aula::where('nombre', 'AULA 01')->value('id'),
            'vacantes'     => 60,
            'semestre_id'  => Semestre::where('nombre', '2023-2')->value('id')
        ]);  
        Programa::firstOrCreate([
            'nombre'       => 'Agro',
            'aula_id'      => Aula::where('nombre', 'AULA 01')->value('id'),
            'vacantes'     => 60,
            'semestre_id'  => Semestre::where('nombre', '2023-2')->value('id')
        ]);                
    }
}
