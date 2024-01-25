<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\SincronizarLecturaJob; // Correct placement for the use statement

class ControllersPlanificar extends Controller
{
    public function rutas()
    {
        return view('Inicio.Planificar.rutas');
    }

/**
 * Comprueba si hay conexi�n con la base de datos MariaDB.
 * 
 * @return bool
 */
public function wilson()
{
    try {

        $notificaciones = DB::connection('mariadb')->table('controlfactura')->get();

        // Ensure all strings are UTF-8 encoded before returning them
        $notificaciones = array_map(function ($notificacion) {
            return array_map(function ($value) {
                // Only convert string values, skip others like integers or nulls
                if (is_string($value)) {
                    return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                }
                return $value;
            }, (array)$notificacion);
        }, $notificaciones);

        return response()->json(['success' => true, 'notificaciones' => $notificaciones]);
    } catch (\Exception $e) {
        Log::error('Error al obtener notificaciones: ' . $e->getMessage());

        // Return a generic error message to the client for security reasons
        return response()->json(['success' => false, 'message' => 'No se pudieron recuperar las notificaciones.']);
    }
}


public function ejecutarSP(Request $request)
{
    $datosSesion = session()->all();
           
    $fecha = $request->input('fecha');
    $iruta = $request->input('iruta');
    $idusuario = $request->input('idusuario');

    try {
        // Ejecutar el procedimiento almacenado
        DB::connection('mariadb')->select('CALL sp_planiruta(?, ?, ?, @resu)', [$fecha, $iruta, $idusuario]);

        // Obtener el valor del parámetro de salida
        $resu = DB::connection('mariadb')->select('SELECT @resu as resu');

        // Extraer solo el valor numérico
        $resuValue = $resu[0]->resu;

        // Devolver solo el valor numérico
        return $resuValue;
    } catch (\Exception $e) {
        // Manejo de errores
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
}




 public function obtenerNotificaciones()
{
    try {
        // Use the specified connection 'mysql_app'
        $notificaciones = DB::connection('mysql_app')->table('notificaciones')->get();

        // Ensure all strings are UTF-8 encoded before returning them
        $notificaciones = array_map(function ($notificacion) {
            return array_map(function ($value) {
                // Only convert string values, skip others like integers or nulls
                if (is_string($value)) {
                    return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
                }
                return $value;
            }, (array)$notificacion);
        }, $notificaciones);

        return response()->json(['success' => true, 'notificaciones' => $notificaciones]);
    } catch (\Exception $e) {
        Log::error('Error al obtener notificaciones: ' . $e->getMessage());

        // Return a generic error message to the client for security reasons
        return response()->json(['success' => false, 'message' => 'No se pudieron recuperar las notificaciones.']);
    }
}

public function obtenerTodasLasLecturas()
{
    try {
        $lecturas = DB::connection('mariadb')
                        ->table('controlfactura')
                        ->where('idControlFactura', 100000)
                        ->get();

        // Limpieza de datos antes de la conversi�n a JSON
        $lecturasArray = array_map(function ($lectura) {
            return array_map(function ($value) {
                if (!is_null($value) && is_string($value)) {
                    // Aseg�rate de que la cadena sea UTF-8, reemplaza los caracteres no UTF-8
                    return mb_convert_encoding($value, 'UTF-8', 'latin1');
                }
                return $value;
            }, (array) $lectura);
        }, $lecturas->toArray());

        // Convertir a JSON con opci�n para escapar caracteres UTF-8 mal formados
        $json = json_encode(['RES' => true, 'lecturas' => $lecturasArray], JSON_INVALID_UTF8_SUBSTITUTE);
        if ($json === false) {
            // Si json_encode devuelve false, hay un problema con la codificaci�n
            throw new \Exception('JSON encode error: ' . json_last_error_msg());
        }

        // Devolver respuesta JSON correctamente codificada
        return response()->json($json);
    } catch (\Exception $e) {
        Log::error('Error al obtener las lecturas', [
            'error' => $e->getMessage(),
            'stack' => $e->getTraceAsString(),
            'code' => $e->getCode()
        ]);
        return response()->json([
            'RES' => false,
            'MSG' => 'Ocurri� un error al recuperar los datos.',
            'error' => $e->getMessage(),
            'code' => $e->getCode()
        ]);
    }
}


     public function insertarLecturaprueba(Request $request)
    {
        $datos = [
            'lectura' => $request->input('lectura'),
            'numero_cuenta' => $request->input('numero_cuenta'),
            'id_usuario' => $request->input('id_usuario'),
            'estado' => $request->input('estado'),
            'soapwrite' => $request->input('soapwrite'),
            'soapread' => $request->input('soapread'),
        ];

        try {
            // Especificamos la conexi�n 'mysql' directamente
            DB::connection('mariadb')->table('controlfactura')->insert($datos);
            return response()->json(['RES' => true, 'MSG' => 'La inserci�n se realiz� con �xito.']);
        } catch (\Exception $e) {
            Log::error('Error al insertar la lectura', ['error' => $e->getMessage(), 'datos' => $datos]);
            return response()->json(['RES' => false, 'MSG' => 'Ocurri� un error al realizar la inserci�n.']);
        }
    }
    public function Errores()
    {
        return view('Error.reporteria');
    }

    public function mapeo()
    {
        return view('Inicio.Planificar.mapa');
    }

    public function sesion()
    {
        $datosSesion = session()->all();

        return view('Inicio.Planificar.sesion');
    }
    function actualizarCalendario($anio, $mes ) {
        //Log::info('Resultados de actualizarCalendario:', ['resultados' => $anio]);
       // Log::info('Resultados de actualizarCalendario:', ['resultados' => $mes]);
        // Establece la conexión con la base de datos
        $conexion = DB::connection('mariadb');
    
        // Prepara la consulta SQL
        $consulta = "SELECT cronograma AS dia, codigo_ciclofacturacion 
                     FROM tb_planiRuta 
                     WHERE idperiodo = (
                         SELECT max(idPeriodo) 
                         FROM tb_pFacturacion 
                         WHERE anio = :anio AND mes = :mes
                     )";
    
        // Ejecuta la consulta con los parámetros proporcionados
        $resultados = $conexion->select($consulta, ['anio' => $anio, 'mes' => $mes]);
    
        // Registro de log con Laravel
       // Log::info('Resultados de actualizarCalendario:', ['resultados' => $resultados]);
    
        // Cierra la conexión (opcional, dependiendo de cómo manejas la conexión)
        $conexion->disconnect();
    
        // Devuelve los resultados
        return $resultados;
    }
  
    function getGrecorrido() {
      
        // Establece la conexión con la base de datos
        $conexion = DB::connection('mariadb');
    
        // Prepara la consulta SQL
        $consulta = "SELECT idgrecorrido,numero_ruta,id_recorrido,georuta,color
                     FROM tb_grecorrido 
                     ";
    
        // Ejecuta la consulta con los parámetros proporcionados
        $resultados = $conexion->select($consulta);
    
        // Registro de log con Laravel
        Log::info('Resultados de actualizarCalendario:', ['resultados' => $resultados]);
    
        // Cierra la conexión (opcional, dependiendo de cómo manejas la conexión)
        $conexion->disconnect();
    
        // Devuelve los resultados
        return $resultados;
        Log::info('Resultados de actualizarCalendario:', ['resultados' => $resultados]);

    }
    function getGrecorridoP($numeroRuta) {
        // Establece la conexión con la base de datos
        $conexion = DB::connection('mariadb');
    
        // Prepara la consulta SQL con filtrado por número de ruta
        $consulta = "SELECT idgrecorrido, numero_ruta, id_recorrido, georuta, color
                     FROM tb_grecorrido 
                     WHERE numero_ruta = :numeroRuta";
    
        // Ejecuta la consulta con el parámetro proporcionado
        $resultados = $conexion->select($consulta, ['numeroRuta' => $numeroRuta]);
    
        // Registro de log con Laravel
       // Log::info('Resultados de getGrecorridoP:', ['resultados' => $resultados]);
    
        // Cierra la conexión (opcional, dependiendo de cómo manejas la conexión)
        $conexion->disconnect();
    
        // Devuelve los resultados
        return $resultados;
    }
    
    public function sincronizarLecturas(Request $request)
    {
        // Validate the data here if necessary

        // Prepare the array of data for insertion
        $datosLectura = [
            "lectura" => $request->lectura,
            "numero_cuenta" => $request->numero_cuenta,
            "id_usuario" => $request->id_usuario,
            "estado" => $request->estado,
            "soapwhrite" => $request->soapwhrite,
            "soapread" => $request->soapread,
        ];

        // Dispatch the job to perform the insertion in the queue
        SincronizarLecturaJob::dispatch($datosLectura);

        // Respond immediately, the insertion will be handled in the background
        return response()->json(["RES" => true, "MSG" => "Synchronization in process"]);
    }

    // ... other methods or functionality for your controller
}
