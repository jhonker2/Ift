<?php

namespace App\Http\Controllers;

use App\Jobs\ColaSincronizacion; // Asegúrate de que esta línea esté presente
use App\Jobs\LectofacturaApp; // Asegúrate de que esta línea esté presente
use Illuminate\Support\Facades\Log;
use phpseclib3\Net\SFTP;
use Illuminate\Http\Request;
use SoapWrapper;
use SoapClient;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

use Illuminate\Support\Facades\Storage;


class ControllersMonitoreo extends Controller
{
    public function anularTramites(Request $request)
    {
        $tramites = $request->input('tramites');
        $idsTramites = explode(',', $tramites);

        foreach ($idsTramites as $idTramite) {
            DB::connection('mysql_aflow')->select('CALL pro_anular_tramite(?, ?)', [$idTramite, null]);
        }

        return response()->json(['message' => 'Trámites anulados correctamente.']);
    }
    public function ID_CUADRILLEROS(Request $request)
    {
        $usuarios = DB::connection('mysql_aflow')
            ->table('v_user_ap')
            ->where('id_rol', 'LECTO_FACTUR')
            ->select('ID_USUARIO', 'NOMBRES')
            ->get();

        return response()->json($usuarios);
    }
    public function ejecutarDesrutal(Request $request)
    {


        $datosSesion = session()->all();




        $iruta = $request->iruta;
        $cantidad = $request->cantidad;
        $irecorrido = $request->irecorrido;
        $idusuario = $request->idusuario;
        $idcuadrilla = $request->idcuadrilla;


        // Usar la conexión 'mariadb'
        $connection = DB::connection('mariadb');

        // Ejecutar el procedimiento almacenado
        $resultado = $connection->select('CALL sp_desrutal(?, ?, ?, ?, ?, @RESU)', [$iruta, $cantidad, $irecorrido, $idusuario, $idcuadrilla]);

        // Obtener el resultado del procedimiento
        $resu = $connection->select('SELECT @RESU as RESU')[0]->RESU;

        return response()->json(['RESU' => $resu]);
    }
    public function update_getdato(Request $request)
    {
        // Recibe los parámetros
        $recorrido = $request->input('recorrido');
        $idRuta = $request->input('idRuta');
        $cuadrilla = $request->input('cuadrilla');
        //Log::info("Recorrido: $recorrido, idRuta: $idRuta, cuadrilla: $cuadrilla");

        // Realiza la consulta para obtener el max_idLectura
        $maxIdLectura = DB::connection('mariadb')
            ->table('tb_desRuta_Lectura as l')
            ->where('l.estado', 'ACTIVO')
            ->where('l.id_recorrido', $recorrido)
            ->where('l.idRuta', $idRuta)
            ->where('l.id_cuadrilla', $cuadrilla)
            ->max('l.idLectura');

        // Verifica si se encontró un maxIdLectura
        if ($maxIdLectura) {
            // Realiza la actualización utilizando el max_idLectura
            DB::connection('mariadb')->table('tb_desRuta_Lectura')
                ->where('idLectura', $maxIdLectura)
                ->update(['estado' => 'INACTIVO']);

            return response()->json(['success' => true, 'maxIdLectura' => $maxIdLectura]);
        } else {
            // En caso de no encontrar un maxIdLectura
            return response()->json(['success' => false, 'maxIdLectura' => null]);
        }
    }

    public function get_datos_d($ruta, $id_recorrido, $cronograma)
    {

        $resultados = DB::connection('mariadb')->select("
        select    u.id_usuario as cedula, l.idRuta as rutas_tabla ,u.nombres as id_cuadrilla, l.id_recorrido as recorrido
from tb_desRuta_Lectura l inner join tbusuarios u on l.id_cuadrilla = u.id_usuario 
 inner join tb_planiRuta t on l.idRuta= t.idRuta  where  l.estado='ACTIVO' and t.ruta = ?
 and l.id_recorrido = ? and t.cronograma = ?
        ", [$ruta, $id_recorrido, $cronograma]);

        return response()->json($resultados);
    }


    public function obtenerDatosT(Request $request)
    {
        $dia = $request->query('dia', date('j')); // Obtiene el día de la solicitud o usa el día actual

        $datos = DB::connection('mariadb')->select("
            SELECT u.id_usuario as cedula, u.nombres as nombre, r.cantidad as cantidad, 
                   r.id_recorrido as recorrido, codigo_cicloFacturacion as ciclo 
            FROM tbusuarios u
            INNER JOIN tb_desRuta_Lectura r ON u.id_usuario = r.id_cuadrilla AND r.estado = 'ACTIVO'
            INNER JOIN (
                SELECT f.dia, f.mes, f.anio, f.periodo_facturacion, r.idRuta, r.cronograma, 
                       r.idPeriodo, r.ruta, r.codigo_cicloFacturacion
                FROM tb_pFacturacion f
                INNER JOIN tb_planiRuta r ON f.idPeriodo = r.idPeriodo AND f.estado = 'ACTIVO'
                AND f.anio = YEAR(NOW()) AND f.mes = MONTH(NOW()) AND r.cronograma = $dia
            ) t ON r.idruta = t.idruta
            WHERE u.id_usuario NOT IN ('1308102837', '0', '1313356782')
            ORDER BY r.id_recorrido
        ");

        return response()->json($datos);
    }

    public function facturas_datos(Request $request)
    {

        $datosSesion = session()->all();

        $usuarioSesion = [
            'SESSION_ID' => session('SESSION_ID'),
            'SESSION_CEDULA' => session('SESSION_CEDULA'),
            'SESSION_USER' => session('SESSION_USER'),
            'SESSION_ROL' => session('SESSION_ROL'),
        ];


        $numero_cuenta = $request->get('numero_cuenta');

        $subQuery = DB::connection('mariadb')
            ->table('controlfactura')
            ->selectRaw('MAX(idControlFactura) as id, numero_cuenta as cuenta')
            ->where('estado', '=', 5) // Condición de estado=2
            ->groupBy('numero_cuenta');

        $conteo = DB::connection('mariadb')
            ->table('controlfactura')
            ->where('estado', '=', 5)
            ->where('soapwhrite', '=', '')
            ->count(); // Usar count() para obtener directamente el número de filas

        $conteo2 = DB::connection('mariadb')
            ->table('sondeo_CE')
            ->where('estado', '=', 0)
            ->count(); // Usar count() para obtener directamente el número de filas



        $subQuerySql = $subQuery->toSql();


        $data = DB::connection('mariadb')
            ->table(DB::raw("($subQuerySql) as b"))
            ->mergeBindings($subQuery) // ¡Importante! Fusiona los parámetros de la subconsulta
            ->join('controlfactura as a', 'a.idControlFactura', '=', 'b.id')
            ->select('a.idControlFactura', 'a.numero_cuenta', 'a.lectura', 'a.estado', 'a.soapwhrite', 'a.id_usuario')
            ->where('a.estado', '=', 5); // Condición de estado=4

        if ($numero_cuenta) {
            $data = $data->where('a.numero_cuenta', '=', $numero_cuenta);
        }

        $data = $data->get();

        $filteredData = []; // Array para almacenar registros filtrados

        foreach ($data as $factura) {
            $decodedSoapwhrite = base64_decode($factura->soapwhrite);

            // Desencriptar lectura
            $factura->lectura = base64_decode($factura->lectura);

            // Usar regex para extraer el valor de resulcode
            if (preg_match('/<resulcode>(\d+)<\/resulcode>/', $decodedSoapwhrite, $matches)) {
                $codigoSoapwhrite = $matches[1];

                // Si el código es diferente de 80000 y 90000, entonces asignar la descripción
                if ($codigoSoapwhrite != '80000' && $codigoSoapwhrite != '90000' && $codigoSoapwhrite != '80807') {
                    // Consultar la descripción en la tabla modelo_osi
                    $descripcion = DB::connection('mariadb')
                        ->table('modelo_osi')
                        ->where('codigo', $codigoSoapwhrite)
                        ->value('decripcion');

                    // Asignar la descripción en lugar del código
                    $factura->soapwhrite = $descripcion;

                    // Agregar el registro al array filtrado
                    $filteredData[] = $factura;
                }
            } else {
                $factura->soapwhrite = null; // o cualquier valor por defecto
            }
        }

        return view('Factura.factura', [
            'data' => $filteredData,
            'conteo' => $conteo,
            'conteo2' => $conteo2
        ]);
    }

    public function reporteria(Request $request)
    {

        $datosSesion = session()->all();

        $usuarioSesion = [
            'SESSION_ID' => session('SESSION_ID'),
            'SESSION_CEDULA' => session('SESSION_CEDULA'),
            'SESSION_USER' => session('SESSION_USER'),
            'SESSION_ROL' => session('SESSION_ROL'),
        ];

        return view('Factura.reporteria', []);
    }
    public function enviarLecturas2()
    {
        // Obtener las lecturas
        $lecturas = DB::connection('mariadb')
            ->table('controlfactura')
            ->selectRaw('MAX(idControlFactura) as idControlFactura, lectura')
            ->where('estado', 20)
            ->groupBy('lectura')
            ->get();

        // Configuración del cliente SOAP
        $wsdl = 'https://sw.portoaguas.gob.ec:443/PORTOAGUASEP/electrofacturacion?WSDL';
        $mySoapClient = new SoapClient($wsdl, [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1
        ]);

        // Procesar cada lectura
        $responses = []; // Para almacenar las respuestas

        foreach ($lecturas as $lectura) {
            try {
                // Codificar la lectura a base64
                $lecturaBase64 = base64_encode($lectura->lectura);

                $response = $mySoapClient->WSPROCESSEDWRITE([
                    'lectura' => $lecturaBase64,  // usar la lectura codificada en base64
                    'user' => 'admin',
                    'password' => 'admin'
                ]);

                // Actualizar la base de datos con la respuesta y la lectura en base64
                DB::connection('mariadb')
                    ->table('controlfactura')
                    ->where('idControlFactura', $lectura->idControlFactura)
                    ->update([
                        'lectura' => $lecturaBase64,  // actualizar el campo lectura con la lectura codificada en base64
                        'soapwhrite' => $response->formato,
                        'estado' => 3
                    ]);

                // Agregar la respuesta al array
                $responses[] = $response->formato;
            } catch (\Exception $e) {
                // Registrar el error y continuar con el siguiente registro
                Log::error('Error al procesar la lectura', ['error' => $e->getMessage(), 'lectura' => $lectura->lectura]);
            }
        }

        return response()->json($responses); // Retorna un array con todas las respuestas base64
    }
    public function getMapboxToken()
    {
        $token = DB::connection('mariadb')
            ->table('mapbox')
            ->value('token'); // Asumiendo que 'token' es el nombre de la columna

        // Retornar el token en formato JSON
        return response()->json(['token' => $token]);
    }

    public function getMapboxstyle()
    {
        $style = DB::connection('mariadb')
            ->table('mapbox')
            ->value('style'); // Asumiendo que 'token' es el nombre de la columna

        // Retornar el token en formato JSON
        return response()->json(['style' => $style]);
    }

    public function enviarLecturasC($numeroCuenta)
    {
        // Obtener las lecturas para el número de cuenta específico
        $lecturas = DB::connection('mariadb')
            ->table('controlfactura')
            ->selectRaw('MAX(idControlFactura) as idControlFactura, lectura')
            ->where('numero_cuenta', $numeroCuenta) // Filtrar por número de cuenta
            ->where('soapwhrite', '=', '') // Verificar que soapwhrite esté vacío
            ->groupBy('lectura')
            ->get();

        // Configuración del cliente SOAP
        $wsdl = 'https://sw.portoaguas.gob.ec:443/PORTOAGUASEP/electrofacturacion?WSDL';
        $mySoapClient = new SoapClient($wsdl, [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1
        ]);

        // Procesar cada lectura
        $responses = []; // Para almacenar las respuestas

        foreach ($lecturas as $lectura) {
            try {
                $response = $mySoapClient->WSPROCESSEDWRITE([
                    'lectura' => $lectura->lectura,
                    'user' => 'admin',
                    'password' => 'admin'
                ]);

                // Determina el nuevo estado basado en si soapwhrite está vacío o no
                $nuevoEstado = empty($response->formato) ? 10 : 3;

                // Actualizar la base de datos con la respuesta
                DB::connection('mariadb')
                    ->table('controlfactura')
                    ->where('idControlFactura', $lectura->idControlFactura)
                    ->update([
                        'soapwhrite' => $response->formato,
                        'estado' => $nuevoEstado
                    ]);

                // Agregar la respuesta al array
                $responses[] = $response->formato;
            } catch (\Exception $e) {
                // Registrar el error y continuar con el siguiente registro
                Log::error('Error al procesar la lectura', ['error' => $e->getMessage(), 'lectura' => $lectura->lectura]);
            }
        }

        return response()->json($responses); // Retorna un array con todas las respuestas base64
    }

    public function enviarLecturas()
    {


        // Obtener las lecturas
        $lecturas = DB::connection('mariadb')
            ->table('controlfactura')
            ->selectRaw('MAX(idControlFactura) as idControlFactura, lectura')
            ->where('estado', 5)
            ->where(function ($query) {
                $query->whereNull('soapwhrite')
                    ->orWhere('soapwhrite', '=', '');
            })
            ->groupBy('lectura')
            ->get();


        // Configuración del cliente SOAP
        $wsdl = 'https://sw.portoaguas.gob.ec:443/PORTOAGUASEP/electrofacturacion?WSDL';
        $mySoapClient = new SoapClient($wsdl, [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1
        ]);

        // Procesar cada lectura
        $responses = []; // Para almacenar las respuestas

        foreach ($lecturas as $lectura) {
            try {
                $response = $mySoapClient->WSPROCESSEDWRITE([
                    'lectura' => $lectura->lectura,
                    'user' => 'admin',
                    'password' => 'admin'
                ]);

                // Actualizar la base de datos con la respuesta
                DB::connection('mariadb')
                    ->table('controlfactura')
                    ->where('idControlFactura', $lectura->idControlFactura)
                    ->update([
                        'soapwhrite' => $response->formato,
                        'estado' => 3
                    ]);

                // Agregar la respuesta al array
                $responses[] = $response->formato;
            } catch (\Exception $e) {
                // Registrar el error y continuar con el siguiente registro
                //Log::error('Error al procesar la lectura', ['error' => $e->getMessage(), 'lectura' => $lectura->lectura]);
                $errores[] = ['idControlFactura' => $lectura->idControlFactura, 'error' => $e->getMessage()];
            }
        }

        return response()->json($responses); // Retorna un array con todas las respuestas base64
    }


    public function enviarLecturasT()
    {


        // Obtener las lecturas
        $lecturas = DB::connection('mariadb')
            ->table('sondeo_CE')
            ->selectRaw('MAX(idControlFactura) as idControlFactura, lectura')
            ->where('estado', 0)
            ->groupBy('lectura')
            ->get();


        // Configuración del cliente SOAP
        $wsdl = 'https://sw.portoaguas.gob.ec:443/PORTOAGUASEP/electrofacturacion?WSDL';
        $mySoapClient = new SoapClient($wsdl, [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1
        ]);

        // Procesar cada lectura
        $responses = []; // Para almacenar las respuestas

        foreach ($lecturas as $lectura) {
            try {
                $response = $mySoapClient->WSPROCESSEDWRITE([
                    'lectura' => $lectura->lectura,
                    'user' => 'admin',
                    'password' => 'admin'
                ]);

                // Actualizar la base de datos con la respuesta
                DB::connection('mariadb')
                    ->table('sondeo_CE')
                    ->where('idControlFactura', $lectura->idControlFactura)
                    ->update([
                        'soapwhrite' => $response->formato,
                        'estado' => 3
                    ]);

                // Agregar la respuesta al array
                $responses[] = $response->formato;
            } catch (\Exception $e) {
                // Registrar el error y continuar con el siguiente registro
                //Log::error('Error al procesar la lectura', ['error' => $e->getMessage(), 'lectura' => $lectura->lectura]);
                $errores[] = ['idControlFactura' => $lectura->idControlFactura, 'error' => $e->getMessage()];
            }
        }

        return response()->json($responses); // Retorna un array con todas las respuestas base64
    }
    public function SondeoE()
    {
        $datosSesion = session()->all();

        $usuarioSesion = [
            'SESSION_ID' => session('SESSION_ID'),
            'SESSION_CEDULA' => session('SESSION_CEDULA'),
            'SESSION_USER' => session('SESSION_USER'),
        ];
        return view('Factura.sondeoE');
    }

    public function monitoreorutas()
    {
        $datosSesion = session()->all();

        $usuarioSesion = [
            'SESSION_ID' => session('SESSION_ID'),
            'SESSION_CEDULA' => session('SESSION_CEDULA'),
            'SESSION_USER' => session('SESSION_USER'),
        ];
        return view('Factura.monitoreorutas');
    }
    public function SondeoP()
    {
        $datosSesion = session()->all();

        $usuarioSesion = [
            'SESSION_ID' => session('SESSION_ID'),
            'SESSION_CEDULA' => session('SESSION_CEDULA'),
            'SESSION_USER' => session('SESSION_USER'),
        ];
        return view('Factura.sondeoP');
    }
    public function facturas_reales(Request $request)
    {
        $datosSesion = session()->all();

        $usuarioSesion = [
            'SESSION_ID' => session('SESSION_ID'),
            'SESSION_CEDULA' => session('SESSION_CEDULA'),
            'SESSION_USER' => session('SESSION_USER'),
        ];

        $numero_cuenta = $request->get('numero_cuenta');

        $data = DB::connection('mariadb')
            ->table('controlfactura as cf')
            ->leftJoin('tbusuarios as u', 'cf.id_usuario', '=', 'u.id_usuario')
            ->select('cf.idControlFactura', DB::raw('((cf.numero_cuenta)) as numero_cuenta'), 'cf.lectura', 'cf.soapwhrite', 'cf.id_usuario as decula')
            ->whereRaw('year(cf.fecha_actualizacion) = year(now())')
            ->whereRaw('month(cf.fecha_actualizacion) = month(now())')
            ->whereNotIn('cf.id_usuario', ['1308102837', '0', '1313356782']);



        if ($numero_cuenta) {
            $data = $data->where('cf.numero_cuenta', '=', $numero_cuenta);
        }

        $data = $data->get();

        $filteredData = [];

        foreach ($data as $factura) {
            $decodedSoapwhrite = base64_decode($factura->soapwhrite);

            // Desencriptar lectura
            $factura->lectura = base64_decode($factura->lectura);

            // Usar regex para extraer el valor de resulcode
            if (preg_match('/<resulcode>(\d+)<\/resulcode>/', $decodedSoapwhrite, $matches)) {
                $codigoSoapwhrite = $matches[1];

                // Si el código es diferente de 80000 y 90000, entonces asignar la descripción
                if ($codigoSoapwhrite == '80000' || $codigoSoapwhrite == '90000' || $codigoSoapwhrite == '80807') {
                    // Consultar la descripción en la tabla modelo_osi
                    $descripcion = DB::connection('mariadb')
                        ->table('modelo_osi')
                        ->where('codigo', $codigoSoapwhrite)
                        ->value('decripcion');

                    // Asignar la descripción en lugar del código
                    $factura->soapwhrite = $descripcion;

                    // Agregar el registro al array filtrado
                    $filteredData[] = $factura;
                }
            } else {
                $factura->soapwhrite = null; // o cualquier valor por defecto
            }
        }

        return view('Factura.facturaR', ['data' => $filteredData]); // Usar $filteredData en lugar de $data
    }


    public function enviarLecturasPorCuenta(Request $request)
    {
        // Obtener la variable 'lectura' y 'idControlFactura' del Request
        $lecturaData = $request->input('lectura');
        $idControlFactura = $request->input('idControlFactura');

        if (!$lecturaData) {
            return response()->json(["error" => "La lectura es requerida."], 400);
        }

        if (!$idControlFactura) {
            return response()->json(["error" => "El idControlFactura es requerido."], 400);
        }

        // Configuración del cliente SOAP
        $wsdl = 'https://sw.portoaguas.gob.ec:443/PORTOAGUASEP/electrofacturacion?WSDL';
        $mySoapClient = new SoapClient($wsdl, [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1
        ]);

        try {
            $response = $mySoapClient->WSPROCESSEDWRITE([
                'lectura' => $lecturaData, // Aquí pasas la data original
                'user' => 'admin',
                'password' => 'admin'
            ]);

            // Actualizar la base de datos con la respuesta del cliente SOAP
            DB::connection('mariadb')
                ->table('controlfactura')
                ->where('idControlFactura', $idControlFactura)
                ->update([
                    'soapwhrite' => $response->formato,
                    'estado' => 3
                ]);


            return response()->json($response->formato); // Retorna la respuesta base64

        } catch (\Exception $e) {
            // Registrar el error
            Log::error('Error al procesar la lectura', ['error' => $e->getMessage(), 'lectura' => $lecturaData]);
            return response()->json(["error" => "Error al procesar la lectura."], 500);
        }
    }

    public function get_ejecutadas(Request $r)
    {
        $sumaEjecutadas = DB::connection('mariadb')
            ->table('total_facturas_v2')
            ->sum('ejecutadas');

        return $sumaEjecutadas;
    }

    public function personalCampo(Request $request)
    {
        $datosSesion = session()->all();

        $usuarioSesion = [
            'SESSION_ID' => session('SESSION_ID'),
            'SESSION_CEDULA' => session('SESSION_CEDULA'),
            'SESSION_USER' => session('SESSION_USER'),
        ];
        $usuarios = DB::connection('mariadb')->table('total_facturas_v2')->get();
        $sumaEjecutadas = DB::connection('mariadb')
            ->table('total_facturas_v2')
            ->sum('ejecutadas');

        $numero_cuenta = $request->get('numero_cuenta');


        $data = DB::connection('mariadb')
            ->table('controlfactura as cf')
            ->leftJoin('tbusuarios as u', 'cf.id_usuario', '=', 'u.id_usuario')
            ->select('cf.idControlFactura', DB::raw('((cf.numero_cuenta)) as numero_cuenta'), 'cf.lectura', 'cf.soapwhrite', 'cf.id_usuario as id_usuario', 'cf.fecha_actualizacion as fecha_actualizacion')
            ->whereRaw('year(cf.fecha_actualizacion) = year(now())')
            ->whereRaw('month(cf.fecha_actualizacion) = month(now())')
            ->whereRaw('day(cf.fecha_actualizacion) = day(now())')
            ->whereNotIn('cf.id_usuario', ['1308102837', '0', '1313356782'])
            ->orderBy('cf.fecha_actualizacion', 'desc'); // Order by fecha_actualizacion in descending order


        if ($numero_cuenta) {
            $data = $data->where('a.numero_cuenta', '=', $numero_cuenta);
        }

        $data = $data->get();
        $listaNumeroCuenta = $data->pluck('numero_cuenta')->unique();

        $totalFotos = $this->contarFotosSubidas($listaNumeroCuenta);

        $filteredData = []; // Array para almacenar registros filtrados

        foreach ($data as $factura) {
            $decodedSoapwhrite = base64_decode($factura->soapwhrite);

            // Desencriptar lectura
            $factura->lectura = base64_decode($factura->lectura);

            // Usar regex para extraer el valor de resulcode
            if (preg_match('/<resulcode>(\d+)<\/resulcode>/', $decodedSoapwhrite, $matches)) {
                $codigoSoapwhrite = $matches[1];

                // Consultar la descripción en la tabla modelo_osi
                $descripcion = DB::connection('mariadb')
                    ->table('modelo_osi')
                    ->where('codigo', $codigoSoapwhrite)
                    ->value('decripcion');

                // Asignar la descripción en lugar del código
                $factura->soapwhrite = $descripcion;

                // Agregar el registro al array filtrado
                $filteredData[] = $factura;
            } else {
                $factura->soapwhrite = null; // o cualquier valor por defecto
            }
        }

        return view('Inicio.Monitoreo.personalCampo', compact('usuarios', 'filteredData', 'sumaEjecutadas', 'totalFotos'));
    }
    public function facturamonitoreo()
    {
        $data = $this->getTotales(); // Obtiene los totales y los totales individuales

        return view('Factura.facturamonitoreo', [
            'totals' => $data['totals'],
            'individual_totals' => $data['individual_totals']
        ]);
    }
    public function getTotales()
    {
        // Aseg�rate de que est�s utilizando la conexi�n correcta a la base de datos 
        $connection = DB::connection('mariadb');

        // Realiza la consulta a la vista total_facturas para obtener todos los registros
        $individualTotals = $connection->table('total_facturas_v2')
            ->get(['usuario', 'ejecutadas']);


        $totalEjecutadas = $individualTotals->sum('ejecutadas');

        // Retorna los resultados
        return [
            'totals' => [
                'total_ejecutadas' => $totalEjecutadas,
            ],
            'individual_totals' => $individualTotals
        ];
    }

    public function downloadFoto($numeroCuenta)
    {

        $direc = Storage::disk('ftp')->allDirectories();
        return $direc;
    }

    public function downloadFile($numeroCuenta)
    {
        $sftp = new \phpseclib3\Net\SFTP('192.168.1.21');
        if (!$sftp->login('root', 'Pinargote1986')) {
            return back()->with('error', 'Error de conexión SFTP.');
        }
        //return $sftp;
        $filename = $numeroCuenta . '.zip';
        return $filename;
        $path = '/usr/share/nginx/html/lecturas/' . $filename;
        if (!$sftp->file_exists($path)) {
            return back()->with('error', 'No hay fotos disponibles para descargar.');
        }

        $contents = $sftp->get($path);
        return $contents;
        return response($contents)->header('Content-Type', 'application/zip')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
    public function contarFotosSubidas($numerosCuenta)
    {
        // Conexión SFTP
        $sftp = new \phpseclib3\Net\SFTP('192.168.1.21');
        if (!$sftp->login('root', 'Pinargote1986')) {
            return response()->json(['error' => 'Error de conexión SFTP.'], 500);
        }

        $path = '/usr/share/nginx/html/lecturas/';

        // Obtener todos los archivos en el directorio
        $allFiles = $sftp->nlist($path);
        $totalFotos = 0;

        foreach ($numerosCuenta as $numeroCuenta) {
            $filename = $numeroCuenta . '.zip';
            if (in_array($filename, $allFiles)) {
                $totalFotos++;
            }
        }

        return $totalFotos;
    }
}
