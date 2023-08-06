<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ["nombre","horas"];


    public function estudiantes()
    {

        return $this->belongsToMany(Curso::class, "curso_estudiante","curso_id","estudiante_id");
    }
}
