<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioProfesor extends Model
{
    protected $table = "adjuntos_profesor";
    protected $primaryKey = "id";
    protected $fillable = [
       'horario',
       'profesor',
    ];
}
