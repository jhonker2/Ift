<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabProceso extends Model
{
    
    protected $table = 'tabproceso'; // Nombre de tu tabla
    protected $fillable = ['idproceso', 'descripcion', 'fecharegistro', 'uregistro', 'fechaactualizacion', 'uactualizacion', 'estado'];

}