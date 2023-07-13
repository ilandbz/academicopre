<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable = ['dni','nombres','apellidop', 'apellidom','fnacimiento', 'email', 'direccion','celular','sexo','foto'];

}
