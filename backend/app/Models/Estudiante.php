<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = ["nombre","apellido","foto"];


    public function cursos()
    {

        return $this->belongsToMany(Estudiante::class, "curso_estudiante","curso_id","estudiante_id");
    }
}
