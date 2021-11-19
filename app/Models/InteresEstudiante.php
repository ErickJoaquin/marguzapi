<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InteresEstudiante extends Model
{
    protected $table = "interes_estudiante";
    protected $primaryKey = "id";
    protected $fillable = [
       'idioma',
       'estudiante'
    ];
}
