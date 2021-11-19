<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "usuarios";
    protected $primaryKey = "id";
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'pais',
        'estado',
        'ciudad',
        'email',
        'foto_perfil',
        'zona_horaria',
        'descripcion',
        'tipo_usuario',
        'titulo_profesional',
        'valor_hora'
    ];
}
