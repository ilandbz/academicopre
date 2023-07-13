<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Persona::firstOrCreate([
            'dni'       => '45532962',
            'nombres'   => 'Cristian Wilmer',
            'apellidop' => 'Figueroa',
            'apellidom' => 'Ferrer',
            'email'     => 'ilandbz@gmail.com'
        ]);
    }
}
