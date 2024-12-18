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

use File;
use Illuminate\Support\Facades\Storage;
use \App\Mail\Notificar;
use Illuminate\Support\Facades\Mail;



class PlanificacionController extends Controller
{
    public function index()
    {
        date_default_timezone_set("America/Guayaquil");
        //$date = "2024-02-25T12:38:40.435251Z"; //Carbon::now();
        $date = Carbon::now();
        // return $date;

        if (Session::get('SESSION_CEDULA')) {
            Session::put('SESSION_PAGE', 'Home');


            if (Session::get('SESSION_ROL') == 'ROL_PL_SIGOP' || Session::get('SESSION_ROL') == 'ROL_DESA') {
                $completados = DB::select('select count(*) as total from tbl_tramites  where estado=2');
                $ejecucion = DB::select('select count(*) as total from tbl_tramites  where estado=1');
                $vencidos = DB::select('SELECT COUNT(id)  as total from tbl_tramites WHERE ESTADO=1 and fecha_fin < now()');

                $compromisos = DB::select('SELECT c.id,c.id_tramite, f.descripcion, tf.descripcion, "dias_retrasado" ,c.fecha_inicio,tt.id_usuario as responsable, "empleado","cargo", c.fecha_fin, c.asunto, c.estado FROM tbl_tramites c
                    INNER JOIN	tbl_tareas_tramites tt on tt.id_tramite = c.id
                    INNER JOIN tbl_fuentes f on f.id= c.id_fuente
                    INNER JOIN tbl_tipos_fuentes tf on tf.id = c.id_tipo_fuente
                    WHERE c.estado=1
                    AND tt.estado ="E"');
            } else {
                $completados = DB::select('select count(*) as total from tbl_tramites  where estado=2 and (responsable=? or usuario_seguimiento = ?)', [Session::get('SESSION_CEDULA'), Session::get('SESSION_CEDULA')]);
                $ejecucion = DB::select('select count(*) as total from tbl_tramites  where estado=1 and (responsable=? or usuario_seguimiento = ?)', [Session::get('SESSION_CEDULA'), Session::get('SESSION_CEDULA')]);
                $vencidos = DB::select('SELECT COUNT(id)  as total from tbl_tramites WHERE ESTADO=1 and fecha_fin < now() and (responsable=? or usuario_seguimiento = ?)', [Session::get('SESSION_CEDULA'), Session::get('SESSION_CEDULA')]);

                $compromisos = DB::select('SELECT c.id,c.id_tramite, f.descripcion, tf.descripcion, "dias_retrasado" ,c.fecha_inicio,c.responsable, "empleado","cargo", c.fecha_fin, c.asunto, c.estado FROM tbl_tramites c
                INNER JOIN tbl_fuentes f on f.id= c.id_fuente
                INNER JOIN tbl_tipos_fuentes tf on tf.id = c.id_tipo_fuente
                WHERE c.estado != 0 and (c.responsable=? or c.usuario_seguimiento = ?) ', [Session::get('SESSION_CEDULA'), Session::get('SESSION_CEDULA')]);
            }



            $usuarios = DB::connection('mysql_aflow')->select('select * from v_user_full');
            //$cc=[];
            foreach ($compromisos as $c) {
                $fecha1 = new \DateTime($date);
                $fecha2 = new \DateTime($c->fecha_fin);
                $diff = $fecha1->diff($fecha2);
                $v = "";
                if ($fecha1 > $fecha2) {
                    if ($diff->days == '0') {
                    } else {
                        $v = "Atrasado";
                    }
                } else {
                    $v = "Quedan";
                }
                // El resultados sera 3 dias
                //echo $diff->days . ' dias';
                foreach ($usuarios as $u) {
                    if ($c->responsable == $u->cedula) {
                        $c->empleado = $u->nombre_corto;
                        $c->cargo = $u->DESCRIPCION;
                        $c->dias_retrasado = $diff->days . ' ' . $v;
                    }
                }
            }
            $completados = $completados[0]->total;
            $ejecucion = $ejecucion[0]->total;
            //  return $compromisos;
            $botones = [];
            return view('Sigop.Tramite.index', compact('compromisos', 'completados', 'ejecucion', 'vencidos', 'botones'));
        } else {
            return Redirect::to('/login');
        }
    }

    public function index2()
    {
        if (Session::get('SESSION_CEDULA')) {

            $date = Carbon::now();

            $usuarioSesion = [
                'user_id' => session('user_id'),
                'id_rol' => session('id_rol'),
                'nombre_corto' => session('nombre_corto'),
                'descripcion' => session('descripcion')
            ];
            Session::put('SESSION_PAGE', 'Home');


            // Pasar los procesos y los datos de la sesión a la vista
            $botones = [];
            $compromisos = DB::select('SELECT c.id, c.id_tramite, f.descripcion, tf.descripcion, "dias_retrasado" ,c.fecha_inicio,c.responsable, "empleado","cargo", c.fecha_fin, c.descripcion, c.estado FROM tbl_tramites c
            INNER JOIN tbl_fuentes f on f.id= c.id_fuente
            INNER JOIN tbl_tipos_fuentes tf on tf.id = c.id_tipo_fuente
            WHERE c.estado=1 and (c.responsable=? or c.usuario_seguimiento = ?)', [Session::get('SESSION_CEDULA'), Session::get('SESSION_CEDULA')]);

            $usuarios = DB::connection('mysql_aflow')->select('select * from v_usuario_activo');
            //$cc=[];
            foreach ($compromisos as $c) {
                $fecha1 = new \DateTime($date);
                $fecha2 = new \DateTime($c->fecha_fin);
                $diff = $fecha1->diff($fecha2);
                $v = "";
                if ($fecha1 > $fecha2) {
                    if ($diff->days == '0') {
                    } else {
                        $v = "Atrasado";
                    }
                } else {
                    $v = "Quedan";
                }
                // El resultados sera 3 dias
                //echo $diff->days . ' dias';
                foreach ($usuarios as $u) {
                    if ($c->responsable == $u->cedula) {
                        $c->empleado = $u->nombre_corto;
                        $c->cargo = $u->DESCRIPCION;
                        $c->dias_retrasado = $diff->days . ' ' . $v;
                    }
                }
            }
            return view('Sigop.Tramite.homeU', compact('usuarioSesion', 'botones', 'compromisos'));
        } else {
            return Redirect::to('/login');
        }
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

    public function proceso($proceso, $tarea, $tramite = 0, $tarea_tramite = 0)
    {

        if (Session::get('SESSION_CEDULA')) {
            Session::put('SESSION_PAGE', 'Home');
            $tiposTramite = DB::table('tbl_tipos_fuentes')->where('estado', 1)->get();
            $fuentes = DB::table('tbl_fuentes')->where('estado', 1)->get();
            $procesos = DB::table('tbl_procesos')->where('id', $proceso)->get();
            $tareas = DB::table('tbl_tareas')->where('id', $tarea)->get();
            $tramite_data = DB::table('tbl_tramites')->where('id', $tramite)->get();
            Session::put('SESSION_PAGE', 'COMPROMISOS');

            if ($tarea_tramite != 0) {
                $tramite_tarea = DB::select("select * from tbl_tareas_tramites where id =  (select max(id) from tbl_tareas_tramites where id_tramite = ? and id = ? )", [$tramite, $tarea_tramite]);
            } else {

                $tramite_tarea = DB::select("select * from tbl_tareas_tramites where id =  (select max(id) from tbl_tareas_tramites where id_tramite = ? and id_tarea = ? and estado = 'P')", [$tramite, $tarea]);
            }
            //return $tramite_tarea;
            /*  if ($tramite_tarea == []) {
               
            } else {*/
            if ($tramite_tarea == []) {
                $botones = DB::select('select c.id, c.id_proceso, c.id_tarea, c.tipo, c.etiqueta, c.icono, f.descripcion, f.query from tbl_campos c
                            LEFT JOIN tbl_funciones f ON f.id_campo = c.id
                            where c.id_proceso =? and c.id_tarea=?', [$proceso, $tarea]);
            } else {
                foreach ($tramite_tarea as $t) {
                    if ($t->estado == 'P') {
                        $botones = [];
                    } else {
                        $botones = DB::select('select c.id, c.id_proceso, c.id_tarea, c.tipo, c.etiqueta, c.icono, f.descripcion, f.query from tbl_campos c
                            LEFT JOIN tbl_funciones f ON f.id_campo = c.id
                            where c.id_proceso =? and c.id_tarea=?', [$proceso, $tarea]);
                    }
                }
            }

            // }


            //$botones = DB::table('tbl_campos')->where('id_proceso', $proceso)->where('id_tarea', $tarea)->get();

            $init = DB::select('select * from tbl_funciones where id_proceso = ? and id_tarea = ? and ISNULL(id_campo)', [$proceso, $tarea]);

            $usuarios = DB::connection('sql_cumpleanos')->select("
        SELECT [IDENTIFICACION]
        ,[NOMBRES]
        ,[CARGO]
        ,[ESTRUCTURA_ORGANICA]
        ,[TIPO_CONTRATO]
        ,[LUGAR_TRABAJO]
        ,[ID_CARGO_ESTRUCTURA_ORGANICA]
        ,[ID_ESTRUCTURA_ORGANICA]
        ,[ESTADO_FUNCIONARIO]
        FROM [saftaguas].[dbo].[EMPLEADOS_ACTIVOS_F]  
        ");
            return view('Sigop.Tramite.proceso', compact('fuentes', 'tiposTramite', 'procesos', 'tareas', 'tramite_data', 'tramite', 'botones', 'init', 'usuarios', 'tarea_tramite'));
        } else {
            return Redirect::to('/login');
        }
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
            $botones = [];

            return view('Sigop.Configuraciones.fuentes', compact('fuentes', 'botones'));
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

    public function update_fuente(Request $r)
    {
        $fuente = DB::table('tbl_fuentes')->where('id', $r->id_fuente)
            ->update([
                'descripcion' => $r->fuente,
            ]);

        if ($fuente >= 1) {
            return response()->json(["respuesta" => true]);
        }
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
        $dele = DB::update('update tbl_fuentes set estado=0 where id=?', [$r->id_fuente]);
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
            $botones = [];
            return view('Sigop.Configuraciones.tiposfuentes', compact('tipos', 'botones'));
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
    public function update_tipo_fuente(Request $r)
    {
        $fuente = DB::table('tbl_tipos_fuentes')->where('id', $r->id_fuente)
            ->update([
                'descripcion' => $r->fuente,
            ]);

        if ($fuente >= 1) {
            return response()->json(["respuesta" => true]);
        }
    }
    public function delete_tipo_fuente(Request $r)
    {
        $dele = DB::update('update tbl_tipos_fuentes set estado=0 where id=?', [$r->id_fuente]);
        if ($dele > 0) {
            return response()->json(["res" => true]);
        } else {
            return response()->json(["res" => false, "sms" => "9998"]);
        }
    }
    public function max_tramite()
    {
        $ultimo_tramite = DB::select('SELECT max(id) + 1  as id_tramite FROM tbl_tramites');
        return $ultimo_tramite[0]->id_tramite;
    }

    public function guardar_tramite($id_tarea, $id_proceso, $fuente, $tipo, $responsable, $fecha_fin, $descripcion, $seguimientoId, $asunto)
    {
        $date = Carbon::now();
        $date_code = $date->format('Y');
        $tramit = '';
        $numero = $this->max_tramite();
        if ($numero < 10) {
            $tramit = '0000' . $numero;
        } else if ($numero < 100) {
            $tramit = '000' . $numero;
        } else if ($numero < 1000) {
            $tramit = '00' . $numero;
        } else if ($numero < 10000) {
            $tramit = '0' . $numero;
        }
        $code_tramite = $date_code . '-' . $tramit;
        // return $code_tramite;
        $tramite = DB::table('tbl_tramites')->insertGetId([
            'id_tramite' => $code_tramite,
            'id_proceso' => $id_proceso,
            'id_fuente' => $fuente,
            'id_tipo_fuente' => $tipo,
            'fecha_inicio' => $date,
            'fecha_fin' => $fecha_fin,
            'asunto' => $asunto,
            'responsable' => $responsable,
            'descripcion' => $descripcion,
            'usuario_registro' => Session::get('SESSION_CEDULA'),
            'usuario_seguimiento' => $seguimientoId,
            'estado' => 0,
            'created_at' => $date,

        ]);
        if ($tramite > 0) {
            // $tarea
            $tarea_Tramite = DB::table('tbl_tareas_tramites')->insertGetId([
                "id_tramite" => $tramite,
                "id_proceso" => $id_proceso,
                "id_tarea" => $id_tarea,
                "id_usuario" => Session::get('SESSION_CEDULA'),
                "estado" => "E",
                'fecha_ejecucion' => $date,
                'fecha_asignacion' => $date,

            ]);
            return  $tramite;
            return response()->json(["tramite" => $tramite, "code_tramite" => $code_tramite]);
        } else {
            return  $tramite;
            return response()->json(["tramite" => $tramite, "code_tramite" => "0"]);
        }
    }

    public function update_tramite($id_tramite, $id_tarea, $id_proceso, $fuente, $tipo, $responsable, $fecha_fin, $descripcion, $seguiminetoId, $asunto)
    {
        $date = Carbon::now();

        $tramite = DB::table('tbl_tramites')->where('id', $id_tramite)
            ->update([
                'id_proceso' => $id_proceso,
                'id_fuente' => $fuente,
                'id_tipo_fuente' => $tipo,
                'fecha_fin' => $fecha_fin,
                'asunto' => $asunto,
                'responsable' => $responsable,
                'descripcion' => $descripcion,
                'usuario_seguimiento' => $seguiminetoId,
                'estado' => 0,
            ]);
        // return $tramite;
        if ($tramite > 0) {
            // $tarea
            /* $tarea_Tramite = DB::table('tbl_tareas_tramites')->insertGetId([
                "id_tramite" => $tramite,
                "id_proceso" => $id_proceso,
                "id_tarea" => $id_tarea,
                "id_usuario" => Session::get('SESSION_CEDULA'),
                "estado" => "E",
                'fecha_ejecucion' => $date,
                'fecha_asignacion' => $date,

            ]);*/
            return $tramite;
        } else {
            return $tramite;
        }
    }

    public function upload_file_ftp(Request $r)
    {
        $date_name = Carbon::now();
        $date_name = $date_name->format('dmYhis');

        $tramite_existe = DB::table('tbl_tramites')->where('id', $r->id_tramite)->get();
        if ($tramite_existe == '[]') {
            $id_tramite = $this->guardar_tramite($r->id_tarea, $r->id_proceso, $r->fuente, $r->tipo, $r->fecha_fin, $r->responsableId, $r->descripcion, $r->seguimientoId, $r->asunto);

            if ($id_tramite == 0) {
                return response()->json(['error' => 'No se pudeo crear el tramite'], 400);
            } else {
                if (!$r->hasFile('file')) {
                    return response()->json(['error' => 'No file uploaded.'], 400);
                }

                $file = $r->file('file');
                $type = $file->getClientOriginalExtension();
                $filename = $id_tramite . '_' . $date_name . '.' . $type;
                $name_origin = $file->getClientOriginalName();

                $ftp = Storage::disk('documentos')->put($filename, File::get($file));
                if ($ftp) {
                    $date = Carbon::now();
                    $t_archivo =  DB::table("tbl_archivo")->insertGetId([
                        "tipo"     => $type,
                        "ruta"     => $filename,
                        "name"     => $name_origin,
                        "created_at"     => $date,
                        "user_created" => Session::get('SESSION_CEDULA')
                    ]);

                    if ($t_archivo > 0) {
                        $tramite_archivo = DB::table('tbl_tramites_archivos')->insertGetId([
                            "id_tramite" => $id_tramite,
                            "id_archivo" => $t_archivo,
                            "id_tarea"   => $r->id_tarea,
                            "created_at" => $date
                        ]);
                        return response()->json(['registro' => true, 'id_tramite' => $id_tramite, 'id_archivo' => $t_archivo, 'name_archivo' => $name_origin], 200);
                    }
                } else {
                    return response()->json(['registro' => false, 'error' => 'File upload failed.'], 500);
                }
            }
            //llamar a la funcion insert_tramite
        } else {
            $up_tramite = $this->update_tramite($r->id_tramite, $r->id_tarea, $r->id_proceso, $r->fuente, $r->tipo, $r->responsableId, $r->fecha_fin, $r->descripcion, $r->seguimientoId, $r->asunto);

            if (!$r->hasFile('file')) {
                return response()->json(['error' => 'No file uploaded.'], 400);
            }

            $file = $r->file('file');
            $type = $file->getClientOriginalExtension();
            $filename = $r->id_tramite . '_' . $date_name . '.' . $type;
            $name_origin = $file->getClientOriginalName();

            $ftp = Storage::disk('documentos')->put($filename, File::get($file));
            if ($ftp) {
                $date = Carbon::now();
                $t_archivo =  DB::table("tbl_archivo")->insertGetId([
                    "tipo"     => $type,
                    "ruta"     =>  $filename,
                    "name"     => $name_origin,
                    "created_at"     => $date,
                    "user_created" => Session::get('SESSION_CEDULA')
                ]);

                if ($t_archivo > 0) {
                    $tramite_archivo = DB::table('tbl_tramites_archivos')->insertGetId([
                        "id_tramite" => $r->id_tramite,
                        "id_archivo" => $t_archivo,
                        "id_tarea"   => $r->id_tarea,
                        "created_at" => $date
                    ]);
                    return response()->json(['registro' => true, 'id_tramite' => $r->id_tramite, 'id_archivo' => $t_archivo, 'name_archivo' => $name_origin], 200);
                }
            } else {
                return response()->json(['registro' => false, 'error' => 'File upload failed.'], 500);
            }
        }
        // Validar que el archivo esté presente



    }

    public function upload_file_ftp_2(Request $r)
    {
        $date_name = Carbon::now();
        $date_name = $date_name->format('dmYhis');

        //$up_tramite = $this->update_tramite($r->id_tramite, $r->id_tarea, $r->id_proceso, $r->fuente, $r->tipo, $r->responsableId, $r->fecha_fin, $r->descripcion);

        if (!$r->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded.'], 400);
        }

        $file = $r->file('file');
        $type = $file->getClientOriginalExtension();
        $filename = $r->id_tramite . '_' . $date_name . '.' . $type;
        $name_origin = $file->getClientOriginalName();

        $ftp = Storage::disk('documentos')->put($filename, File::get($file));
        if ($ftp) {
            $date = Carbon::now();
            $t_archivo =  DB::table("tbl_archivo")->insertGetId([
                "tipo"     => $type,
                "ruta"     =>  $filename,
                "name"     => $name_origin,
                "created_at"     => $date,
                "user_created" => Session::get('SESSION_CEDULA')
            ]);

            if ($t_archivo > 0) {
                $tramite_archivo = DB::table('tbl_tramites_archivos')->insertGetId([
                    "id_tramite" => $r->id_tramite,
                    "id_archivo" => $t_archivo,
                    "id_tarea"   => $r->id_tarea,
                    "created_at" => $date
                ]);
                return response()->json(['registro' => true, 'id_tramite' => $r->id_tramite, 'id_archivo' => $t_archivo, 'name_archivo' => $name_origin], 200);
            }
        } else {
            return response()->json(['registro' => false, 'error' => 'File upload failed.'], 500);
        }
        // Validar que el archivo esté presente



    }


    public function store_compromisos(Request $r)
    {
        $date = Carbon::now();
        if ($r->id_tramite == '0') {
            $fechaf = new Carbon($r->fecha_fin);
            $id_tramite = $this->guardar_tramite($r->id_tarea, $r->id_proceso, $r->fuente, $r->tipo, $r->responsableId, $fechaf, $r->descripcion, $r->seguimientoId, $r->asunto);
            // return $id_tramite->tramite;
            if ($id_tramite > 0) {
                $tramite_ = DB::table('tbl_tramites')->where('id', $id_tramite)->get();
                $code = "";
                foreach ($tramite_ as $c) {
                    $code = $c->id_tramite;
                }
                return response()->json(["respuesta" => true, 'id_tramite' => $id_tramite, 'code_tramite' => $code, 'sms' => 'Cambios guardados correctamente']);
            } else {
                return response()->json(["respuesta" => false]);
            }
        } else {
            $fechaf = new Carbon($r->fecha_fin);
            //return $r->seguimientoId;
            $up_tramite = $this->update_tramite($r->id_tramite, $r->id_tarea, $r->id_proceso, $r->fuente, $r->tipo, $r->responsableId, $fechaf, $r->descripcion, $r->seguimientoId, $r->asunto);
            //return $up_tramite;
            if ($up_tramite > 0) {
                return response()->json(["respuesta" => true, 'id_tramite' => $r->id_tramite, 'sms' => 'Cambios guardados correctamente']);
            } else if ($up_tramite == 0) {
                return response()->json(["respuesta" => true, 'id_tramite' => $r->id_tramite, 'sms' => 'Sin cambios que guardar']);
            } else {
                return response()->json(["respuesta" => false]);
            }
        }
    }

    public function tarea_tramites($tramite)
    {
        $tareas_tramites = DB::select('SELECT tt.id, tt.id_tramite,tt.id_tarea,tt.id_proceso, tp.descripcion as proceso, ta.descripcion as tarea, tt.id_usuario,"empleado","rol", tt.estado, tt.fecha_ejecucion, tt.fecha_fin, tt.fecha_asignacion FROM tbl_tareas_tramites tt 
        INNER JOIN tbl_tareas ta ON ta.id=tt.id_tarea
        INNER JOIN tbl_procesos tp ON tp.id=tt.id_proceso
        where id_tramite=? ORDER BY tt.id ASC', [$tramite]);

        $usuarios = DB::connection('mysql_aflow')->select('select * from v_user_full');
        //$cc=[];
        foreach ($tareas_tramites as $c) {
            foreach ($usuarios as $u) {
                if ($c->id_usuario == $u->cedula) {
                    $c->empleado = $u->nombres . ' ' . $u->apellidos;
                    //$c->rol = $
                }
            }
        }
        return $tareas_tramites;
    }

    public function FRM_COMPROMISO($proceso, $tarea, $tramite)
    {

        if (Session::get('SESSION_CEDULA')) {
            if (isset($proceso) || isset($tarea) || isset($tramite)) {

                Session::put('SESSION_PAGE', 'Compromisos>REGISTRO DE COMPROMISOS');
                $tipos = DB::table('tbl_tipos_fuentes')->where('estado', 1)->get();
                $botones = DB::table('tbl_campos')->where('id_proceso', $proceso)->where('id_tarea', $tarea)->get();

                return view('Sigop.FRM_Tareas.compromisos', compact('tipos', 'tramite', 'proceso', 'tarea', 'botones'));
            } else {
                return Redirect::to('/home');
            }
        } else {
            return Redirect::to('/login');
        }
    }

    public function borrador()
    {
        if (Session::get('SESSION_CEDULA')) {
            Session::put('SESSION_PAGE', 'Borradores');
            $tramites = DB::select('SELECT t.id,t.id_proceso,tt.id_tarea,t.responsable,t.usuario_registro,t.estado, t.created_at  FROM tbl_tramites t
            INNER JOIN tbl_tareas_tramites tt ON tt.id_tramite = t.id
            where t.estado=0 and t.usuario_registro=?', [Session::get('SESSION_CEDULA')]); //DB::table('tbl_tramites')->where('estado', 0)->where('usuario_registro', Session::get('SESSION_CEDULA'))->get();
            $botones = [];
            return view('Sigop.Borrador.index', compact('tramites', 'botones'));
        } else {
            return Redirect::to('/login');
        }
    }

    public function nuevas()
    {
        if (Session::get('SESSION_CEDULA')) {
            Session::put('SESSION_PAGE', 'Borradores');
            $tramites = DB::select("
            select t.id,tt.id as id_tarea,t.id_proceso,t.id_tramite,p.descripcion as proceso,t.fecha_inicio, ta.descripcion as tarea, t.estado from tbl_tramites t 
            INNER JOIN tbl_tareas_tramites tt ON t.id=tt.id_tramite
            INNER JOIN tbl_procesos p ON p.id = tt.id_proceso
            INNER JOIN tbl_tareas ta ON ta.id = tt.id_tarea
            where tt.estado = 'E' and tt.id_usuario = ? and t.estado=1  ORDER BY 1 desc", [Session::get('SESSION_CEDULA')]); //DB::table('tbl_tramites')->where('estado', 0)->where('usuario_registro', Session::get('SESSION_CEDULA'))->get();
            $botones = [];
            return view('Sigop.Nuevas.index', compact('tramites', 'botones'));
        } else {
            return Redirect::to('/login');
        }
    }

    public function open_tramite_borrador($id_tramite, $id_tarea)
    {
        //$tramite = DB::table('tbl_tramites')->where('id', $id_tramite)->get();
        $tramite = DB::select('SELECT t.id,t.id_proceso,t.id_fuente,t.id_tipo_fuente,t.fecha_inicio,t.fecha_fin, t.fecha_ext,t.responsable,t.descripcion,t.usuario_seguimiento,t.usuario_registro,t.estado,
        f.descripcion as fuente, tf.descripcion as tipo_fuente FROM tbl_tramites t 
        INNER JOIN tbl_fuentes f ON f.id = t.id_fuente
        INNER JOIN tbl_tipos_fuentes tf ON tf.id = t.id_tipo_fuente
        WHERE t.id = ?', [$id_tramite]);

        $tarea_tramite = DB::select("select * from tbl_tareas_tramites where id_tramite=? and id_tarea=? and estado = 'E'", [$id_tramite, $id_tarea]);
        $archivos = DB::select('select * from tbl_tramites_archivos ta
        INNER JOIN tbl_archivo a ON a.id=ta.id_archivo
        where ta.id_tramite = ?', [$id_tramite]);
        return response()->json(["respuesta" => true, 'tramite' => $tramite, 'archivos' => $archivos, 'tarea_tramite' => $tarea_tramite]);
    }
    public function open_tramite($id_tramite)
    {
        //$tramite = DB::table('tbl_tramites')->where('id', $id_tramite)->get();
        $tramite = DB::select('SELECT t.id,t.id_proceso,t.id_fuente,t.id_tipo_fuente,t.fecha_inicio,t.fecha_fin, t.fecha_ext,t.responsable,t.descripcion,t.usuario_registro,t.estado,
        f.descripcion as fuente, tf.descripcion as tipo_fuente FROM tbl_tramites t 
        INNER JOIN tbl_fuentes f ON f.id = t.id_fuente
        INNER JOIN tbl_tipos_fuentes tf ON tf.id = t.id_tipo_fuente
        WHERE t.id = ?', [$id_tramite]);

        $tarea_tramite = DB::select("select * from tbl_tareas_tramites where id_tramite=?", [$id_tramite]);
        $archivos = DB::select('select * from tbl_tramites_archivos ta
        INNER JOIN tbl_archivo a ON a.id=ta.id_archivo
        where ta.id_tramite = ?', [$id_tramite]);
        return response()->json(["respuesta" => true, 'tramite' => $tramite, 'archivos' => $archivos, 'tarea_tramite' => $tarea_tramite]);
    }

    public function ps_enviar_tarea_2(Request $r)
    {

        $date = Carbon::now();

        $tarea_siguiente = DB::select('select id_tarea_destino FROM tbl_caminos where id_proceso=? and id_tarea_origen=?', [$r->id_proceso, $r->id_tarea]);
        $usuario_responsable = DB::select("select * from tbl_tareas_tramites where id_tramite=? and id_tarea=1 and estado = 'P'", [$r->id_tramite]);
        // return  $usuario_responsable[0]->id_usuario;
        $procesar = DB::table('tbl_tareas_tramites')
            ->where('id_tramite', $r->id_tramite)
            ->where('id_proceso', $r->id_proceso)
            ->where('id_tarea', $r->id_tarea)
            ->where('id_usuario', $r->user_session_activa)
            ->update([
                'estado' => 'P',
                'fecha_fin' => $date
            ]);

        if ($procesar >= 1) {
            $insert_tarea = DB::table('tbl_tareas_tramites')->insertGetId([
                "id_tramite" => $r->id_tramite,
                "id_proceso" => $r->id_proceso,
                "id_tarea" => $tarea_siguiente[0]->id_tarea_destino,
                "id_usuario" => $usuario_responsable[0]->id_usuario,
                "estado" => "E",
                'fecha_ejecucion' => $date,
                'fecha_asignacion' => $date,
            ]);
            return response()->json(["respuesta" => true, 'sms' => "tramite enviado correctamente"]);
        }
    }
    public function ps_enviar_tarea_4(Request $r)
    {

        $date = Carbon::now();
        //tarea 4
        if ($r->estado_confirmado == "true") { //true
            //3
            $tarea_siguiente = DB::select('select id_tarea_destino FROM tbl_caminos where id_proceso=? and id_tarea_origen=?', [$r->id_proceso, $r->id_tarea]);
            $usuario = $r->user_session_activa;
            $procesar = DB::table('tbl_tareas_tramites')
                ->where('id_tramite', $r->id_tramite)
                ->where('id_proceso', $r->id_proceso)
                ->where('id_tarea', $r->id_tarea)
                ->where('id_usuario', $r->user_session_activa)
                ->update([
                    'estado' => 'P',
                    'fecha_fin' => $date
                ]);
            if ($procesar >= 1) {
                $tram = DB::table('tbl_tramites')
                    ->where('id', $r->id_tramite)
                    ->where('id_proceso', $r->id_proceso)
                    ->update([
                        'estado' => 2,
                    ]);
                $insert_tarea = DB::table('tbl_tareas_tramites')->insertGetId([
                    "id_tramite" => $r->id_tramite,
                    "id_proceso" => $r->id_proceso,
                    "id_tarea" => $tarea_siguiente[0]->id_tarea_destino,
                    "id_usuario" => $usuario,
                    "estado" => "P",
                    'fecha_ejecucion' => $date,
                    'fecha_asignacion' => $date,
                ]);

                return response()->json(["respuesta" => true, 'sms' => "tramite finalizado correctamente"]);
            }
        } else {
            //2
            $tarea_siguiente = DB::select('select IFNULL(id_tarea_origen, 0) as id_tarea_destino from  tbl_caminos where id_proceso=? and id_tarea_destino=?', [$r->id_proceso, $r->id_tarea]);
            $usuario_responsable = DB::select("select * from tbl_tareas_tramites where id=(select max(id) from tbl_tareas_tramites where id_tramite=? and id_tarea=? and estado = 'P')", [$r->id_tramite, $tarea_siguiente[0]->id_tarea_destino]);
            $usuario = $usuario_responsable[0]->id_usuario;
            $procesar = DB::table('tbl_tareas_tramites')
                ->where('id_tramite', $r->id_tramite)
                ->where('id_proceso', $r->id_proceso)
                ->where('id_tarea', $r->id_tarea)
                ->where('id_usuario', $r->user_session_activa)
                ->update([
                    'estado' => 'P',
                    'fecha_fin' => $date
                ]);

            if ($procesar >= 1) {
                /* $tram = DB::table('tbl_tramites')
                    ->where('id', $r->id_tramite)
                    ->where('id_proceso', $r->id_proceso)
                    ->update([
                        'estado' => 2,
                    ]);*/
                $insert_tarea = DB::table('tbl_tareas_tramites')->insertGetId([
                    "id_tramite" => $r->id_tramite,
                    "id_proceso" => $r->id_proceso,
                    "id_tarea" => $tarea_siguiente[0]->id_tarea_destino,
                    "id_usuario" => $usuario,
                    "estado" => "E",
                    'fecha_ejecucion' => $date,
                    'fecha_asignacion' => $date,
                ]);

                return response()->json(["respuesta" => true, 'sms' => "tramite finalizado correctamente"]);
            }
        }

        //return $usuario_responsable;
        // return  $usuario_responsable[0]->id_usuario;

    }


    public function get_email_user($cedula)
    {
        $correo = DB::connection('sql_cumpleanos')->select('SELECT MAIL_INSTITUCIONAL FROM [dbo].[SIS_PERSONAS] where NUMERO_IDENTIFICACION = ?', [$cedula]);

        return $correo[0]->MAIL_INSTITUCIONAL;
    }

    public function get_user($cedula)
    {
        //return $cedula;
        $correo = DB::connection('sql_cumpleanos')->select("SELECT CONCAT(NOMBRES,' ',APELLIDOS) AS USUARIO FROM [dbo].[SIS_PERSONAS] where NUMERO_IDENTIFICACION = '$cedula'");
        return $correo[0]->USUARIO;
        /*foreach ($correo as $c) {
            return $c->USUARIO;
        }*/
    }
    public function ps_enviar_tramite(Request $r)
    {
        $date = Carbon::now();
        //return $r->responsableId;
        //$usuario = $this->get_user($r->responsableId);
        //return $usuario;
        $tarea_siguiente = DB::select('select id_tarea_destino FROM tbl_caminos where id_proceso=? and id_tarea_origen=?', [$r->id_proceso, $r->id_tarea]);

        $procesar = DB::table('tbl_tareas_tramites')
            ->where('id_tramite', $r->id_tramite)
            ->where('id_proceso', $r->id_proceso)
            ->where('id_tarea', $r->id_tarea)
            ->update([
                'estado' => 'P',
            ]);

        if ($procesar >= 1) {
            $insert_tarea = DB::table('tbl_tareas_tramites')->insertGetId([
                "id_tramite" => $r->id_tramite,
                "id_proceso" => $r->id_proceso,
                "id_tarea" => $tarea_siguiente[0]->id_tarea_destino,
                "id_usuario" => $r->responsableId,
                "estado" => "E",
                'fecha_ejecucion' => $date,
                'fecha_asignacion' => $date,
            ]);

            if ($insert_tarea > 0) {
                $tram = DB::table('tbl_tramites')
                    ->where('id', $r->id_tramite)
                    ->where('id_proceso', $r->id_proceso)
                    ->update([
                        'estado' => 1,
                    ]);

                if ($r->id_tarea == 1) {
                    $tramitedata = DB::select('select * from tbl_tramites where id=?', [$r->id_tramite]);
                    $email = $this->get_email_user($r->responsableId);
                    $usuario = $this->get_user($r->responsableId);

                    if ($email != '') {
                        foreach ($tramitedata as $t) {
                            $usuario_solicitante = $this->get_user($t->usuario_registro);
                            $fecha_envio = $t->fecha_inicio;
                            $fecha_compro = $t->fecha_fin;

                            $email = Mail::to($email, 'Portoaguas')->send(new Notificar($t->id_tramite, $t->asunto, $usuario, $usuario_solicitante, $fecha_envio, $fecha_compro));
                        }
                    }
                    //$correo = DB::connection('sql_cumpleanos')->
                }
                return response()->json(["respuesta" => true, 'sms' => "tramite enviado correctamente"]);
            }
        }
    }

    public function sp_devolver_tarea(Request $r)
    {
        $id_tarea_devolver = DB::select('select IFNULL(id_tarea_origen, 0) as id_tarea from  tbl_caminos where id_proceso=? and id_tarea_destino=?', [$r->id_proceso, $r->id_tarea]);

        return $id_tarea_devolver;
    }

    public function sp_reasignar_tarea(Request $r)
    {
        $date = Carbon::now();

        $tram = DB::table('tbl_tareas_tramites')
            ->where('id_tramite', $r->id_tramite)
            ->where('id', $r->id_tarea_tramite)
            ->update([
                'estado' => "A",
                'observacion' => $r->observacion
            ]);
        if ($tram > 0) {
            $tarea_Tramite = DB::table('tbl_tareas_tramites')->insertGetId([
                "id_tramite" => $r->id_tramite,
                "id_proceso" => $r->id_proceso,
                "id_tarea" => $r->id_tarea,
                "id_usuario" => $r->usuario,
                "estado" => "E",
                'fecha_ejecucion' => $date,
                'fecha_asignacion' => $date,

            ]);

            if ($tarea_Tramite > 0) {
                return response()->json(["respuesta" => true, 'sms' => "Tarea se reasigno correctamente"]);
            } else {
                return response()->json(["respuesta" => false, 'sms' => "Error al Guardar la tarea"]);
            }
        } else {
            return response()->json(["respuesta" => false, 'sms' => "Error al Guardar la tarea"]);
        }
    }

    public function sp_guardar_tarea(Request $r)
    {
        if ($r->id_tarea == 2) {
            $tram = DB::table('tbl_tareas_tramites')
                ->where('id_tramite', $r->id_tramite)
                ->where('id_proceso', $r->id_proceso)
                ->where('id_tarea', $r->id_tarea)
                ->where('id_usuario', $r->user_session_activa)
                ->update([
                    'observacion' => $r->descripcion,
                ]);
        } else if ($r->id_tarea == 4) {
            $tram = DB::table('tbl_tareas_tramites')
                ->where('id_tramite', $r->id_tramite)
                ->where('id_proceso', $r->id_proceso)
                ->where('id_tarea', $r->id_tarea)
                ->where('id_usuario', $r->user_session_activa)
                ->update([
                    'observacion' => $r->descripcion,
                    'estado_confirmacion' => $r->estado_confirmado
                ]);
        }


        if ($tram == 1) {
            return response()->json(["respuesta" => true, 'sms' => "Tarea Guardada correctamente"]);
        } else {
            return response()->json(["respuesta" => false, 'sms' => "Error al Guardar la tarea"]);
        }
    }

    public function sp_delete_file($id_archivo)
    {
        $archivo = DB::table('tbl_archivo')->where('id', $id_archivo)->get();
        foreach ($archivo as $a) {
            $de = Storage::disk('documentos')->delete($a->ruta);
            if ($de == 1) {
                DB::table('tbl_archivo')->where('id', $id_archivo)->delete();
                DB::table('tbl_tramites_archivos')->where('id_archivo', $id_archivo)->delete();
                return response()->json(["respuesta" => true, 'sms' => "ok"]);
            } else {
                return response()->json(["respuesta" => false, 'sms' => "Error"]);
            }
        }
    }
    public function sp_download_file($id_archivo)
    {
        $archivo = DB::table('tbl_archivo')->where('id', $id_archivo)->get();
        foreach ($archivo as $a) {
            $de = Storage::disk('documentos')->download($a->ruta);
            return $de;
            if ($de == 1) {
                return response()->json(["respuesta" => true, 'sms' => "ok"]);
            } else {
                return response()->json(["respuesta" => false, 'sms' => "Error"]);
            }
        }
    }

    public function GET_archivos(Request $r)
    {

        $archivos = DB::select('select * from tbl_archivo a
        INNER JOIN tbl_tramites_archivos ta ON a.id = ta.id_archivo
        where ta.id_tramite =? and ta.id_tarea =?', [$r->id_tramite, $r->id_tarea]);

        return response()->json(["respuesta" => true, 'archivos' => $archivos, 'id_tarea' => $r->id_tarea, 'id_tramite' => $r->id_tramite]);
    }

    public function Getcompromisos($tipo)
    {
        date_default_timezone_set("America/Guayaquil");
        //$date = "2024-02-25T12:38:40.435251Z"; //Carbon::now();
        $date = Carbon::now();
        $usuarios = DB::connection('mysql_aflow')->select('select * from v_user_full');

        if ($tipo == 2) {
            $compromisos = DB::select('SELECT c.id,c.id_tramite, f.descripcion, tf.descripcion, "dias_retrasado" ,c.fecha_inicio,c.responsable, "empleado","cargo", c.fecha_fin, c.descripcion, c.estado FROM tbl_tramites c
            INNER JOIN tbl_fuentes f on f.id= c.id_fuente
            INNER JOIN tbl_tipos_fuentes tf on tf.id = c.id_tipo_fuente
            WHERE c.estado=1');
        } else if ($tipo == 1) {
            $compromisos = DB::select('SELECT c.id,c.id_tramite, f.descripcion, tf.descripcion, "dias_retrasado" ,c.fecha_inicio,c.responsable, "empleado","cargo", c.fecha_fin, c.descripcion, c.estado FROM tbl_tramites c
            INNER JOIN tbl_fuentes f on f.id= c.id_fuente
            INNER JOIN tbl_tipos_fuentes tf on tf.id = c.id_tipo_fuente
            WHERE c.estado=2');
        } else {
            $compromisos = DB::select('SELECT c.id,c.id_tramite, f.descripcion, tf.descripcion, "dias_retrasado" ,c.fecha_inicio,c.responsable, "empleado","cargo", c.fecha_fin, c.descripcion, c.estado FROM tbl_tramites c
            INNER JOIN tbl_fuentes f on f.id= c.id_fuente
            INNER JOIN tbl_tipos_fuentes tf on tf.id = c.id_tipo_fuente
            WHERE c.estado=1 and c.fecha_fin < now()');
        }


        foreach ($compromisos as $c) {
            $fecha1 = new \DateTime($date);
            $fecha2 = new \DateTime($c->fecha_fin);
            $diff = $fecha1->diff($fecha2);
            $v = "";
            if ($fecha1 > $fecha2) {
                if ($diff->days == '0') {
                } else {
                    $v = "Atrasado";
                }
            } else {
                $v = "Quedan";
            }
            // El resultados sera 3 dias
            //echo $diff->days . ' dias';
            foreach ($usuarios as $u) {
                if ($c->responsable == $u->cedula) {
                    $c->empleado = $u->nombre_corto;
                    $c->cargo = $u->DESCRIPCION;
                    $c->dias_retrasado = $diff->days . ' ' . $v;
                }
            }
        }
        return $compromisos;
    }

    public function Getcompromisos_user($tipo)
    {
        date_default_timezone_set("America/Guayaquil");
        //$date = "2024-02-25T12:38:40.435251Z"; //Carbon::now();
        $date = Carbon::now();
        $usuarios = DB::connection('mysql_aflow')->select('select * from v_user_full');

        if ($tipo == 2) {
            $compromisos = DB::select('SELECT c.id,c.id_tramite, f.descripcion, tf.descripcion, "dias_retrasado" ,c.fecha_inicio,c.responsable, "empleado","cargo", c.fecha_fin, c.descripcion, c.estado FROM tbl_tramites c
            INNER JOIN tbl_fuentes f on f.id= c.id_fuente
            INNER JOIN tbl_tipos_fuentes tf on tf.id = c.id_tipo_fuente
            WHERE c.estado=1 and (c.responsable = ? or c.usuario_seguimiento=?)', [Session::get('SESSION_CEDULA'), Session::get('SESSION_CEDULA')]);
        } else if ($tipo == 1) {
            $compromisos = DB::select('SELECT c.id,c.id_tramite, f.descripcion, tf.descripcion, "dias_retrasado" ,c.fecha_inicio,c.responsable, "empleado","cargo", c.fecha_fin, c.descripcion, c.estado FROM tbl_tramites c
            INNER JOIN tbl_fuentes f on f.id= c.id_fuente
            INNER JOIN tbl_tipos_fuentes tf on tf.id = c.id_tipo_fuente
            WHERE c.estado=2 and (c.responsable = ? or c.usuario_seguimiento=?)', [Session::get('SESSION_CEDULA'), Session::get('SESSION_CEDULA')]);
        } else {
            $compromisos = DB::select('SELECT c.id,c.id_tramite, f.descripcion, tf.descripcion, "dias_retrasado" ,c.fecha_inicio,c.responsable, "empleado","cargo", c.fecha_fin, c.descripcion, c.estado FROM tbl_tramites c
            INNER JOIN tbl_fuentes f on f.id= c.id_fuente
            INNER JOIN tbl_tipos_fuentes tf on tf.id = c.id_tipo_fuente
            WHERE c.estado=1 and c.fecha_fin < now() and (c.responsable = ? or c.usuario_seguimiento=?)', [Session::get('SESSION_CEDULA'), Session::get('SESSION_CEDULA')]);
        }


        foreach ($compromisos as $c) {
            $fecha1 = new \DateTime($date);
            $fecha2 = new \DateTime($c->fecha_fin);
            $diff = $fecha1->diff($fecha2);
            $v = "";
            if ($fecha1 > $fecha2) {
                if ($diff->days == '0') {
                } else {
                    $v = "Atrasado";
                }
            } else {
                $v = "Quedan";
            }
            // El resultados sera 3 dias
            //echo $diff->days . ' dias';
            foreach ($usuarios as $u) {
                if ($c->responsable == $u->cedula) {
                    $c->empleado = $u->nombre_corto;
                    $c->cargo = $u->DESCRIPCION;
                    $c->dias_retrasado = $diff->days . ' ' . $v;
                }
            }
        }
        return $compromisos;
    }

    public function dashboard()
    {
        if (Session::get('SESSION_CEDULA')) {
            Session::put('SESSION_PAGE', 'Dashboard v1.0');

            $botones = [];
            return view('Sigop.Dashboard.index', compact('botones'));
        } else {
            return Redirect::to('/login');
        }
    }

    public function get_series_fuentes()
    {
        $series = DB::select('select f.descripcion, count(t.id) as total_tramites from tbl_tramites t
        INNER JOIN tbl_fuentes f ON f.id = t.id_fuente
        and t.estado !=0 						
        GROUP BY f.descripcion');
        return $series;
    }

    public function get_series_tfuentes()
    {
        $series = DB::select('select f.descripcion, count(t.id) as total_tramites from tbl_tramites t
        INNER JOIN tbl_tipos_fuentes f ON f.id = t.id_fuente
        and t.estado !=0 						
        GROUP BY f.descripcion');
        return $series;
    }

    public function get_ttramites(Request $r)
    {
        $series = DB::select("select 'ejecucion' as titpo, COUNT(*) total from tbl_tramites where fecha_inicio BETWEEN '$r->fecha_inicio' and '$r->fecha_fin' and estado=1 and fecha_fin>NOW()
                              union ALL
                              select 'completados' as titpo, COUNT(*) total from tbl_tramites where fecha_inicio BETWEEN '$r->fecha_inicio' and '$r->fecha_fin'	 and estado=2
                              union all   
                              select 'vencidos' as titpo, COUNT(*) total from tbl_tramites where fecha_inicio BETWEEN '$r->fecha_inicio' and '$r->fecha_fin' and estado=1 and fecha_fin< NOW()
                              union all 
                              select 'total' as titpo, COUNT(*) total from tbl_tramites where fecha_inicio BETWEEN '$r->fecha_inicio' and '$r->fecha_fin'");
        return $series;
    }

    public function enviar_correo()
    {
        $email = Mail::to('jhonker2@hotmail.com', 'Jhony Guaman')->send(new Notificar("12345", "ASUNTO DE PRUEBA", "JHONY", "GUAMAN", "15/04/2024", "16/04/2024"));
    }
}
