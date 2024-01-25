<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabcampoP extends Model
{
    protected $table = 'tabcampoP'; // Nombre de tu tabla
    protected $fillable = ['Id_proceso', 'Descripcion', 'Codigo_Proceso'];
}
