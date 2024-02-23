<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\TabcampoP;
use App\Models\TabProceso;
use App\Models\DetallecampoP;
use App\Models\TabTipoTramite;
use App\Models\TabFuente;
use App\Models\TabTramite;
use SoapWrapper;
use Redirect;
use Session;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlanificacionController extends Controller
{
    public function index()
    {
        if (Session::get('SESSION_CEDULA')) {
            // $campos = TabcampoP::all();
            // $procesos = TabProceso::where('estado', 'ACTIVO')->get();
            Session::put('SESSION_PAGE', 'Home');

            return view('Sigop.Tramite.index');
        } else {
            return Redirect::to('/login');
        }
    }
    public function index2()
    {
        $campos = TabcampoP::all();

        // Obtener los procesos
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();

        // Obtener los datos de la sesión
        $usuarioSesion = [
            'user_id' => session('user_id'),
            'id_rol' => session('id_rol'),
            'nombre_corto' => session('nombre_corto'),
            'descripcion' => session('descripcion')
        ];
        Session::put('SESSION_PAGE', 'Home');


        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.homeU', compact('procesos', 'usuarioSesion', 'campos'));
    }

    public function showForm($idProceso)
    {
        $datosSesion = session()->all();
        $campos = TabcampoP::all();
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();

        $detalles = DetallecampoP::where('Id_proceso', $idProceso)->get();
        $usuarioSesion = [
            'user_id' => session('user_id'),
            'id_rol' => session('id_rol'),
            'nombre_corto' => session('nombre_corto'),
            'descripcion' => session('descripcion')
        ];

        $plantilla_noti = DB::table('tabplantillanotificacion')->where('estado', '=', 'ACTIVO')->get();
        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.Tareas', compact('detalles', 'procesos', 'usuarioSesion', 'campos', 'plantilla_noti'));
    }



    public function tareas()
    {
        $datosSesion = session()->all();
        $campos = TabcampoP::all();
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();
        $usuarioSesion = [
            'user_id' => session('user_id'),
            'id_rol' => session('id_rol'),
            'nombre_corto' => session('nombre_corto'),
            'descripcion' => session('descripcion')
        ];

        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.Tareas', compact('procesos', 'usuarioSesion', 'campos'));
    }

    public function guardarProcesoEnSesion(Request $request, $procesoId)
    {
        // Aquí guardas el proceso en la sesión
        session(['proceso_seleccionado' => $procesoId]);

        // Retorna una respuesta
        return response()->json(['message' => 'Proceso guardado en sesión']);
    }

    public function proceso()
    {

        if (Session::get('SESSION_CEDULA')) {
            Session::put('SESSION_PAGE', 'Home');
            // $datosSesion = session()->all();
            $tiposTramite = DB::table('tbl_tipos_fuentes')->where('estado', 1)->get();
            $fuentes = DB::table('tbl_fuentes')->where('estado', 1)->get();
            Session::put('SESSION_PAGE', 'COMPROMISOS');
            return view('Sigop.Tramite.proceso', compact('fuentes', 'tiposTramite'));
        } else {
            return Redirect::to('/login');
        }
        // Aquí continúas con el resto de tu lógica existente

    }
    public function mistramites()
    {
        $datosSesion = session()->all();
        $campos = TabcampoP::all();
        //session
        // Obtener los procesos
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();
        // Obtener los datos de la sesión
        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.interfaces.mistramites', compact('procesos', 'campos'));
    }
    public function mensajeria2()
    {
        $datosSesion = session()->all();
        $campos = TabcampoP::all();
        //session
        // Obtener los procesos
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();
        // Obtener los datos de la sesión
        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.mensajeria', compact('procesos', 'campos'));
    }
    // En tu controlador de autenticación
    public function obtenerClave($clave)
    {
        // Puedes optar por registrar el valor del parámetro recibido, si es necesario
        Log::info("Valor de clave recibido: " . $clave);
        // Devolver directamente la clave estática, independientemente del valor del parámetro
        return response()->json(['clave' => 'Bestsarada29*']);
    }

    public function get_empleados(Request $request)
    {
        $nombres = $request->input('nombres'); // Retrieve the 'nombres' parameter from the request

        $empleados = DB::connection('sql_cumpleanos')->select("
        SELECT TOP 10 [IDENTIFICACION]
        ,[NOMBRES]
        ,[CARGO]
        ,[ESTRUCTURA_ORGANICA]
        ,[TIPO_CONTRATO]
        ,[LUGAR_TRABAJO]
        ,[ID_CARGO_ESTRUCTURA_ORGANICA]
        ,[ID_ESTRUCTURA_ORGANICA]
        ,[ESTADO_FUNCIONARIO]
        FROM [saftaguas].[dbo].[EMPLEADOS_ACTIVOS_F]  
        WHERE [NOMBRES] LIKE ? OR [IDENTIFICACION] LIKE ? OR [CARGO] LIKE ?
        ", ['%' . $nombres . '%', '%' . $nombres . '%', '%' . $nombres . '%']);
        return response()->json($empleados);
    }


    public function logout()
    {
        // Cerrar sesión
        session()->flush();
        // Redirigir a la página de inicio o login
        return redirect('/login');
    }

    //EDITANDO..
    public function fuente(Request $request)
    {
        $descripcion = $request->only(['inputSolicitante']);
        return $descripcion;

        return view('Sigop.Tramite.fuente');
    }



    public function notificaciones()
    {
        $datosSesion = session()->all();

        // Obtener los procesos
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();

        // Obtener los datos de la sesión
        $usuarioSesion = [
            'user_id' => session('user_id'),
            'id_rol' => session('id_rol'),
            'nombre_corto' => session('nombre_corto'),
            'descripcion' => session('descripcion')
        ];

        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.interfaces.notifi', compact('procesos', 'usuarioSesion'));
    }


    public function mensajeria()
    {
        $datosSesion = session()->all();

        // Obtener los procesos
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();

        // Obtener los datos de la sesión
        $usuarioSesion = [
            'user_id' => session('user_id'),
            'id_rol' => session('id_rol'),
            'nombre_corto' => session('nombre_corto'),
            'descripcion' => session('descripcion')
        ];

        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.interfaces.mensajeria', compact('procesos', 'usuarioSesion'));
    }
    public function proceso2()
    {
        $datosSesion = session()->all();

        // Obtener los procesos
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();

        // Obtener los datos de la sesión
        $usuarioSesion = [
            'user_id' => session('user_id'),
            'id_rol' => session('id_rol'),
            'nombre_corto' => session('nombre_corto'),
            'descripcion' => session('descripcion')
        ];

        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.proceso', compact('procesos', 'usuarioSesion'));
    }
    public function plantillanotificacion()
    {
        return view('Sigop.Tramite.PlantillaNotificacion');
    }

    public function caminos()
    {
        return view('Sigop.Tramite.Caminos');
    }

    public function entregable()
    {
        return view('Sigop.Tramite.Entregable');
    }

    public function base()
    { //REVISANDO..................................
        $datosSesion = session()->all();

        // Obtener los procesos
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();

        // Obtener los datos de la sesión
        $usuarioSesion = [
            'user_id' => session('user_id'),
            'id_rol' => session('id_rol'),
            'nombre_corto' => session('nombre_corto'),
            'descripcion' => session('descripcion')
        ];
        return view('Sigop.Tramite.base', ['tareas' => view('Tramite.Tareas')], compact('procesos', 'usuarioSesion'));
    }


    public function login()
    {
        if (Session::get('SESSION_CEDULA')) {
            return Redirect::to('/home');
            //return view('Sigop.Tramite.index');
        } else {
            return view('Sigop.login');
        }
    }


    public function fuentes()
    {
        if (Session::get('SESSION_CEDULA')) {
            Session::put('SESSION_PAGE', 'Configuración de fuentes');
            $fuentes = DB::table('tbl_fuentes')->where('estado', 1)->get();
            return view('Sigop.Configuraciones.fuentes', compact('fuentes'));
        } else {
            return Redirect::to('/login');
        }
    }

    public function store_fuente(Request $r)
    {
        $date = Carbon::now();
        $fuentes = DB::table('tbl_fuentes')->insertGetId([
            'descripcion' => $r->fuente,
            'created_at' => $date,
            'usuario_registro' => Session::get('SESSION_CEDULA'),
            'estado' => 1,
        ]);
        return response()->json(["respuesta" => true]);
    }

    public function get_fuentes()
    {
        $fuentes = DB::table('tbl_fuentes')->where('estado', 1)->get();
        return response()->json(['data' => $fuentes, 'respuesta' => true]);
    }

    public function edit(Request $r)
    {
        $dele = DB::update('update tbl_fuentes set descripcion=? where id=?', [$r->descripcion, $r->idfuente]);
        if ($dele > 0) {
            return response()->json(["res" => true]);
        } else {
            return response()->json(["res" => false, "sms" => "9998"]);
        }
    }


    public function delete_fuente(Request $r)
    {
        $dele = DB::update('update tbl_fuentes set estado=0 where id=?', [$r->idfuente]);
        if ($dele > 0) {
            return response()->json(["res" => true]);
        } else {
            return response()->json(["res" => false, "sms" => "9998"]);
        }
    }

    public function tipos_fuentes()
    {
        if (Session::get('SESSION_CEDULA')) {
            Session::put('SESSION_PAGE', 'Configuración tipo de fuentes');

            $tipos = DB::table('tbl_tipos_fuentes')->where('estado', 1)->get();

            return view('Sigop.Configuraciones.tiposfuentes', compact('tipos'));
        } else {
            return Redirect::to('/login');
        }
    }

    public function get_tipos_fuentes()
    {
        $fuentes = DB::table('tbl_tipos_fuentes')->where('estado', 1)->get();
        return response()->json(['data' => $fuentes, 'respuesta' => true]);
    }

    public function store_tipo_fuente(Request $r)
    {
        $date = Carbon::now();
        $fuentes = DB::table('tbl_tipos_fuentes')->insertGetId([
            'descripcion' => $r->tipo,
            'created_at' => $date,
            'usuario_registro' => Session::get('SESSION_CEDULA'),
            'estado' => 1,
        ]);
        if ($fuentes > 0) {
            return response()->json(["respuesta" => true]);
        } else {
            return response()->json(["respuesta" => false]);
        }
    }
}
