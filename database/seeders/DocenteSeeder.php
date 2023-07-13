<?php

namespace Database\Seeders;

use App\Models\Docente;
use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Docente::firstOrCreate([
            'tipocontrato'  => 'Contratado',
            'persona_id'  => Persona::where('email', 'ilandbz@gmail.com')->value('id'),
        ]);
    }
}
