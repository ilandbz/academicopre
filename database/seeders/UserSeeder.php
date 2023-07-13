<?php

namespace Database\Seeders;

use App\Models\Persona;
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
            'email'       => 'administrador@gmail.com',
            'password'    => Hash::make('123456789'),
            'role_id'     => Role::where('nombre', 'Administrador')->value('id'),
            'persona_id'  => Persona::where('email', 'ilandbz@gmail.com')->value('id'),
        ]);
        User::firstOrCreate([
            'email'       => 'maestro@gmail.com',
            'password'    => Hash::make('123456789'),
            'role_id'     => Role::where('nombre', 'Maestro')->value('id'),
            'persona_id'  => Persona::where('email', 'ilandbz@gmail.com')->value('id'),

        ]);
        User::firstOrCreate([
            'email'       => 'alumno@gmail.com',
            'password'    => Hash::make('123456789'),
            'role_id'     => Role::where('nombre', 'Alumno')->value('id'),
            'persona_id'  => Persona::where('email', 'ilandbz@gmail.com')->value('id'),
        ]);


    }
}
