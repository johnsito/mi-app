<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';
    protected $fillable = ['titulo', 'completada'];
    protected $casts = ['completada' => 'boolean'];
}
