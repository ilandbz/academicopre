<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Programa extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','aula_id','vacantes', 'semestre_id'];

    public function aula(): BelongsTo
    {
        return $this->belongsTo(Aula::class, 'aula_id');
    }
    public function semestre(): BelongsTo
    {
        return $this->belongsTo(Semestre::class, 'semestre_id');
    }
}
