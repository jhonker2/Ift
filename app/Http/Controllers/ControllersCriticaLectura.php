<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllersCriticaLectura extends Controller
{
    public function criticaLectura()
    {
       return view('Inicio.Critica_Lectura.CriticaLectura');
    }
    
}

