<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdjuntoProfesor extends Model
{
    protected $table = "adjuntos_profesor";
    protected $primaryKey = "id";
    protected $fillable = [
       'documentacion',
       'cedula',
       'id_usuario',
    ];
}
