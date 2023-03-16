<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecuperarSenhas extends Model
{
    protected $fillable = [
        'id_usuarios',
        'time',
        'token'
    ];
}
