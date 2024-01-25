<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ControllersCobranza extends Controller
{
    public function cobranza()
    {    $datosSesion = session()->all();

        $datos = DB::connection('mariadb')->select("
        SELECT u.id_usuario as cedula, u.nombres as nombre, r.cantidad as cantidad, r.id_recorrido as recorrido, codigo_cicloFacturacion as ciclo 
        FROM tbusuarios u
        INNER JOIN tb_desRuta_Lectura r ON u.id_usuario = r.id_cuadrilla AND r.estado = 'ACTIVO'
        INNER JOIN (
            SELECT f.dia, f.mes, f.anio, f.periodo_facturacion, r.idRuta, r.cronograma, r.idPeriodo, r.ruta, r.codigo_cicloFacturacion
            FROM tb_pFacturacion f
            INNER JOIN tb_planiRuta r ON f.idPeriodo = r.idPeriodo AND f.estado = 'ACTIVO'
            AND f.anio = YEAR(NOW()) AND f.mes = MONTH(NOW()) AND r.cronograma = DAY(NOW())
        ) t ON r.idruta = t.idruta
        WHERE u.id_usuario NOT IN ('1308102837', '0', '1313356782')
        ORDER BY r.id_recorrido
    ");

        $usuarios = DB::connection('mariadb')->table('total_facturas_v2')->get();
    
        $usuarioSesion = [
            'SESSION_ID' => session('SESSION_ID'),
            'SESSION_CEDULA' => session('SESSION_CEDULA'),
            'SESSION_USER' => session('SESSION_USER'),    ];

            return view('Cobranza.reporteria', compact('usuarios','datos'));

    }

    
    
}

