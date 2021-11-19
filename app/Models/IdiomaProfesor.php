<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdiomaProfesor extends Model
{
    protected $table = "idioma_profesor";
    protected $primaryKey = "id";
    protected $fillable = [
       'idioma',
       'profesor'
    ];
}
