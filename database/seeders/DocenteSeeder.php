<?php

namespace Database\Seeders;

use App\Models\Docente;
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
            'nombres'       => 'docente',
            'apellidos'     => 'Figueroa Ferrer',
            'dni'           => '12457863',
            'email'         => 'docente@gmail.com',
            'password'      => Hash::make('123456789'),
            'sexo'          => 'M',
            'tipocontrato'  => 'Contratado'
        ]);
    }
}
