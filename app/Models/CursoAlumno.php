<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoAlumno extends Model
{
    use HasFactory;
    protected $fillable=['curso_id', 'alumno_id', 'estado', 'Nota'];
}
