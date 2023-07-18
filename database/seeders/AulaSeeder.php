<?php

namespace Database\Seeders;

use App\Models\Aula;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aula::firstorCreate([
            'nombre'=> 'AULA 01',
            'piso'      => 1,
            'numero'    => 20,
            'aforo'     => 60,
            'seccion'   => 'A'
        ]);
        Aula::firstorCreate([
            'nombre'=> 'AULA 02',
            'piso'      => 1,
            'numero'    => 20,
            'aforo'     => 60,
            'seccion'   => 'B'
        ]);        
        Aula::firstorCreate([
            'nombre'=> 'AULA 03',
            'piso'      => 2,
            'numero'    => 20,
            'aforo'     => 60,
            'seccion'   => 'C'
        ]);
    }
}
