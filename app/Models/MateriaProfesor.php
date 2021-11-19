<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriaProfesor extends Model
{
    protected $table = "materia_profesor";
    protected $primaryKey = "id";
    protected $fillable = [
       'materia',
       'profesor'
    ];
}
