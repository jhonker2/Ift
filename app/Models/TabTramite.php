<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabTramite extends Model
{


    protected $table = 'tabtramite'; // Especificar el nombre correcto de la tabla
    public $timestamps = false; // Desactivar timestamps automáticos

    protected $fillable = [
        'idcompromiso', 'idfuente', 'idproceso', 'idtipocompromiso',
        'fechainicio', 'fechafin', 'uregistro', 'solicitante', 
        'estado', 'fechaactualizacion', 'uactualizacion'
    ];

}
