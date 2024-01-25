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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PlanificacionController extends Controller
{
    public function index()
    {    
        $campos = TabcampoP::all();

        // Obtener los procesos
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();

        // Obtener los datos de la sesión


        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.index', compact('procesos', 'campos'));
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


        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.homeU', compact('procesos', 'usuarioSesion', 'campos'));
    }
    
    public function showForm($idProceso)
    {   $datosSesion = session()->all();
        $campos = TabcampoP::all();
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();

        $detalles = DetallecampoP::where('Id_proceso', $idProceso)->get();
        $usuarioSesion = [
            'user_id' => session('user_id'),
            'id_rol' => session('id_rol'),
            'nombre_corto' => session('nombre_corto'),
            'descripcion' => session('descripcion')
        ];

        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.Tareas', compact('detalles','procesos', 'usuarioSesion', 'campos'));
    }
    

 
    public function tareas()
    {    $datosSesion = session()->all();
        $campos = TabcampoP::all();
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();
        $usuarioSesion = [
            'user_id' => session('user_id'),
            'id_rol' => session('id_rol'),
            'nombre_corto' => session('nombre_corto'),
            'descripcion' => session('descripcion')
        ];

        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.Tareas', compact('procesos', 'usuarioSesion','campos'));
    }

    public function guardarProcesoEnSesion(Request $request, $procesoId)
{
    // Aquí guardas el proceso en la sesión
    session(['proceso_seleccionado' => $procesoId]);

    // Retorna una respuesta
    return response()->json(['message' => 'Proceso guardado en sesión']);
}

public function proceso($id_compromiso)
{
    // Guardar el id_compromiso en la sesión
    session(['sesion_idproceso' => $id_compromiso]);

    // Aquí continúas con el resto de tu lógica existente
    $datosSesion = session()->all();
    $campos = TabcampoP::all();
    $procesos = TabProceso::where('estado', 'ACTIVO')->get();
     $tiposTramite = TabTipoTramite::where('estado', 'ACTIVO')->pluck('descripcion', 'idtipocompromiso');
     $fuentes = TabFuente::where('estado', 'ACTIVO')->pluck('descripcion', 'idfuente');



    return view('Sigop.Tramite.proceso', compact('fuentes','tiposTramite', 'procesos', 'campos'));

}
public function mistramites()
    {    $datosSesion = session()->all();
        $campos = TabcampoP::all();
        //session
        // Obtener los procesos
        $procesos = TabProceso::where('estado', 'ACTIVO')->get();
        // Obtener los datos de la sesión
        // Pasar los procesos y los datos de la sesión a la vista
        return view('Sigop.Tramite.interfaces.mistramites', compact('procesos', 'campos'));
    }
    public function mensajeria2()
    {    $datosSesion = session()->all();
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

    public function get_empleados(Request $request) {
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
        ", ['%'.$nombres.'%', '%'.$nombres.'%', '%'.$nombres.'%']); 
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
    public function fuente(Request $request){
        $descripcion = $request->only(['inputSolicitante']);

        return view('Sigop.Tramite.fuente');
    }

   

    public function notificaciones()
    {    $datosSesion = session()->all();

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
    {    $datosSesion = session()->all();

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
    {    $datosSesion = session()->all();

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
    public function plantillanotificacion(){
        return view('Sigop.Tramite.PlantillaNotificacion');
    }

    public function caminos(){
        return view('Sigop.Tramite.Caminos');
    }

    public function entregable(){
        return view('Sigop.Tramite.Entregable');
    }

    public function base(){ //REVISANDO..................................
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
        return view('Sigop.Tramite.base', ['tareas'=>view('Tramite.Tareas')], compact('procesos', 'usuarioSesion'));
    }


    public function login(){
        return view('Sigop.login');
    }
  
}
