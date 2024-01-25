<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DetallecampoP extends Model
{
    protected $table = 'detallecampoP'; // Nombre de tu tabla

    // Si quieres permitir la asignación masiva de cualquier columna
    protected $guarded = []; 

    // O si prefieres especificar solo los campos fijos
    // protected $fillable = ['Id_proceso', 'texto1', 'texto2', 'combo1'];
    
    // Si tus campos varían, probablemente necesitarás lógica adicional
    // en tus métodos para manejar esta variabilidad.
}