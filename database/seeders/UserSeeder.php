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
            'name'        => 'ilandbz',
            'email'       => 'ilandbz@gmail.com',
            'nombres'     => 'Cristian Wilmer',
            'apellidos'   => 'Figueroa Ferrer',
            'password'    => Hash::make('123456789'),
            'sexo'        => 'M',
            'role_id'     => Role::where('nombre', 'Administrador')->value('id'),
            'foto'        => 'default.png',
        ]);
    }
}
