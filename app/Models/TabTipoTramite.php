<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabTipoTramite extends Model
{     

    protected $table = 'tabtipotramite';
    protected $fillable = ['descripcion', 'fecharegistro', 'uregistro', 'fechaactualizacion', 'uactualizacion', 'estado'];
}
