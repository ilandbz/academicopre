<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::firstOrCreate([
            'name'        => 'administrador',
            'email'       => 'administrador@gmail.com',
            'nombres'     => 'Cristian Wilmer',
            'apellidos'   => 'Figueroa Ferrer',
            'password'    => Hash::make('123456789'),
            'sexo'        => 'M',
            'role_id'     => Role::where('nombre', 'Administrador')->value('id'),
            'foto'        => 'default.png',
        ]);
        User::firstOrCreate([
            'name'        => 'maestro',
            'email'       => 'maestro@gmail.com',
            'nombres'     => 'Cristian Wilmer',
            'apellidos'   => 'Figueroa Ferrer',
            'password'    => Hash::make('123456789'),
            'sexo'        => 'M',
            'role_id'     => Role::where('nombre', 'Maestro')->value('id'),
            'foto'        => 'default.png',
        ]);
        User::firstOrCreate([
            'name'        => 'alumno',
            'email'       => 'alumno@gmail.com',
            'nombres'     => 'Cristian Wilmer',
            'apellidos'   => 'Figueroa Ferrer',
            'password'    => Hash::make('123456789'),
            'sexo'        => 'M',
            'role_id'     => Role::where('nombre', 'Alumno')->value('id'),
            'foto'        => 'default.png',
        ]);


    }
}
