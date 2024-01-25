<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllersReportesIndicadores extends Controller
{
    public function balance()
    {
       return view('Inicio.Reportes_indicadores.Balance');
    }

    public function reporte()
    {
       return view('Inicio.Reportes_indicadores.Reporte');
    }

    public function dashboard()
    {
       return view('Inicio.Reportes_indicadores.Dashboard');
    }
    
}
