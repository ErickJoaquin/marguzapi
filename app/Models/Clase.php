<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $table = "clases";
    protected $primaryKey = "id";
    protected $fillable = [
       'hora',
       'fecha',
       'email',
       'descripcion',
       'estado',
       'cantidad'
    ];
}
