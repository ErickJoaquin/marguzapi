<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = "horarios";
    protected $primaryKey = "id";
    protected $fillable = [
       'dia',
       'hora_inicio',
       'hora_fin'
    ];
}
