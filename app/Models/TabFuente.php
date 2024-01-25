<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabFuente extends Model
{
    protected $table = 'tabfuente';
    protected $fillable = ['descripcion', 'fecharegistro', 'uregistro', 'fechaactualizacion', 'uactualizacion', 'estado'];
}
