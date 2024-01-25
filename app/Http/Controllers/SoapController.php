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

class SoapController extends Controller
{   
    const WSDL_CACHE_NONE = 0;
    public function sincronizarLecturasSoap(Request $request)
    {
        $data = $request->only(['lectura', 'numero_cuenta', 'id_usuario', 'soapwhrite', 'soapread', 'estado']);
        ColaSincronizacion::dispatch($data);

        return response()->json(["RES" => true, "MSG" => "Proceso de sincronización iniciado"]);
    }
    
    //return response()->json($response->formato); // Retorna la respuesta base64

 //OJO MODIFICAR CONEXIONES LOGIN
    public function autenticacion(Request $request)
    {
      $fecha = Carbon::now();
      $id_usuario = 0;
      $nombreU = "";
      $cargoU  = "";
      $rolU    = "";
      $clave = $this->getclave($request->clave);
      $usuario_cedula = DB::connection('mysql_aflow')->select("Select * from v_user_ap where ID_USUARIO = ?", [$request->cedula]);
      if ($usuario_cedula != []) { // si existen registros con esa cedula
        $usuario_clave = DB::connection('mysql_aflow')->select("Select * from v_user_ap where clave = ? and ID_USUARIO = ?", [$clave, $request->cedula]);
        if ($usuario_clave != []) { //Si existe registros con esa clave
          foreach ($usuario_clave as $usu) {
            $id_usuario = $usu->ID_USUARIO;
            $nombreU = $usu->NOMBRES;
            $cargoU = $usu->col;
            $rolU   = $usu->id_rol;
          }
          $dispositivo   =    DB::connection('mysql2')->select("Select * from dispositivos where id_movil= ?", [$request->id_Dispositivo]);
          if ($dispositivo != []) { // Si existe registro con ese idDispositivo
            $id_dispositivo = 0;
            foreach ($dispositivo as $dis) {
              $id_dispositivo = $dis->id;
            }
            $dis_usuario = DB::connection('mysql2')->select("Select * from dispositivo_usuarios where usuario_id = ? and estado = ? ", [$request->cedula, 'online']);
            if ($dis_usuario != []) {
              //USUARIO YA INICIO SESION
              return response()->json(["respuesta" => "Eduplicado", "id_usu" => null, "nombre_usu" => null, "cargo_usu"  => null]);
            } else {
              DispositivoUsuario::create([
                "dispositivo_id" => $id_dispositivo,
                "usuario_id"     => $id_usuario,
                "estado"         => "online",
                "fecha_inicial"  => $fecha
              ]);
              $usuarioSystem = DB::select("select * from usuario_systems where cedula= ?", [$id_usuario]);
              if ($usuarioSystem == []) {
                Usuario_system::create([
                  "cedula"    => $id_usuario,
                  "nombre"    => $nombreU,
                  "estado"    => "online",
                  "col"       => $cargoU
                ]);
              } else {
                $usuarioup = DB::update('update usuario_systems set estado = "online",col=?  where cedula=?', [$cargoU, $id_usuario]);
              }
              //login correcto
              return response()->json([
                "respuesta" => "Login Correcto",
                "id_usu" => $id_usuario,
                "nombre_usu" => $nombreU,
                "cargo_usu"  => $cargoU,
                "roles_usu"  => $rolU,
                "agente" => "NULL"
              ]);
            }
          } else {
            Dispositivo::create(['id_movil' => $request->id_Dispositivo]);
            $dispositivo   =    DB::select("Select * from dispositivos where id_movil= ?", [$request->id_Dispositivo]);
            if ($dispositivo != []) { // Si existe registro con ese idDispositivo
              $id_dispositivo = 0;
              foreach ($dispositivo as $dis) {
                $id_dispositivo = $dis->id;
              }
              $dis_usuario = DB::select("Select * from dispositivo_usuarios where usuario_id = ? and estado = ? ", [$id_usuario, 'online']);
              if ($dis_usuario != []) {
                return response()->json(["respuesta" => "Eduplicado", "id_usu" => null, "nombre_usu" => null, "cargo_usu"  => null]);
              } else {
                DispositivoUsuario::create([
                  "dispositivo_id" => $id_dispositivo,
                  "usuario_id"     => $id_usuario,
                  "estado"         => "online",
                  "fecha_inicial"  => $fecha
                ]);
                $usuarioSystem = DB::select("select * from usuario_systems where cedula= ?", [$id_usuario]);
    
                if ($usuarioSystem == []) {
                  Usuario_system::create([
                    "cedula"    => $id_usuario,
                    "nombre"    => $nombreU,
                    "estado"    => "online",
                    "col"       => $cargoU
                  ]);
                } else {
                  $usuarioup = DB::update('update usuario_systems set estado = "online", col = ? where cedula=?', [$cargoU, $id_usuario]);
                }
                return response()->json(["respuesta" => "Login Correcto", "id_usu" => $id_usuario, "nombre_usu" => $nombreU, "cargo_usu"  => $cargoU, "agente" => null]);
              }
            }
          }
        } else { // No existe registro con esa clave
          return response()->json(["respuesta" => "Eclave", "id_usu" => null, "nombre_usu" => null, "cargo_usu"  => null, "roles_usu"  => null]);
        }
      } else { // No existen registro con esa cedula
        return response()->json(["respuesta" => "Ecedula", "id_usu" => null, "nombre_usu" => null, "cargo_usu"  => null, "roles_usu"  => null]);
      }
    }
    public function logout(Request $request){
        $user_login = DB::connection('mysql2')->select("select u.cedula,u.nombre from usuario_systems u, dispositivos d, dispositivo_usuarios du where d.id_movil=? and du.estado='online' and u.cedula=?",[$request->id_dispositivo, $request->id_usuario]);
           if($user_login!=[]){
               $date = Carbon::now();
               $usuario = DB::update('update dispositivo_usuarios set estado = "offline", fecha_final = ? where usuario_id=? and estado = ?',[$date,$request->id_usuario,"online"]);
               $usu = DB::update('update usuario_systems set estado = "offline" where cedula=?',[$request->id_usuario]);
                   if($usuario==1){
                       return response()->json(["respuesta"=>"cerrada"]);
                   }else{
                       return response()->json(["respuesta"=>"No_cerrada"]);
                   }
           }else{
               return response()->json(["respuesta"=>"No_cerrada"]);
           }

   }

    public function php_info()
    {
        return response()->view('phpinfo')->header('Content-Type', 'text/html');
    }
    public function getControlData()
    {
        try {
            $data = DB::connection('mariadb')->table('modelo_osi')->get();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener datos: ' . $e->getMessage()], 500);
        }
    }
    public function soapwrite(Request $request)
{
    try {
        // Asegurarse de que 'numero_cuenta' se envía en el JSON
        if (!$request->has('numero_cuenta')) {
            return response()->json(['error' => 'No se proporcionaron cuentas'], 400);
        }

        // Obtener el array de 'numero_cuenta' del JSON
        $cuentas = $request->input('numero_cuenta');

        // Validar que $cuentas es un array y contiene elementos
        if (!is_array($cuentas) || empty($cuentas)) {
            return response()->json(['error' => 'Formato de cuentas inválido'], 400);
        }

        // Realizar la consulta
        $data = DB::connection('mariadb')  // Aunque dice 'mysql', Laravel lo usa para MariaDB también
        ->table('controlfactura as cf')
        ->joinSub(
            'SELECT numero_cuenta, MAX(idControlFactura) AS maximo FROM controlfactura WHERE numero_cuenta IN (' . implode(',', $cuentas) . ') GROUP BY numero_cuenta',
            'agrupacion',
            function ($join) {
                $join->on('cf.numero_cuenta', '=', 'agrupacion.numero_cuenta')
                     ->on('cf.idControlFactura', '=', 'agrupacion.maximo');
            }
        )
        ->select('cf.soapwhrite','cf.numero_cuenta')  // Selecciona solo la columna 'soapwhrite'
        ->get();
    

        return response()->json($data, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al obtener datos: ' . $e->getMessage()], 500);
    }
}

public function enviarFacturaImprimir(Request $request)
{
    $factura = $request->input('factura');

    // Configuración del cliente SOAP
    $wsdl = 'https://sw.portoaguas.gob.ec:443/PORTOAGUASEP/electrofacturacion?WSDL';
    $mySoapClient = new SoapClient($wsdl, [
        'cache_wsdl' => WSDL_CACHE_NONE,
        'trace' => 1
    ]);

    try {
        // Llamar al servicio SOAP con el parámetro factura
        $response = $mySoapClient->WSPROCESSEDREAD_V2([
            'cuenta' => $factura
        ]);

        // Retornar directamente el valor en formato base64
        return response($response->formato);

    } catch (\Exception $e) {
        // Registrar el error y retornar un mensaje de error
        Log::error('Error al procesar la factura', ['error' => $e->getMessage(), 'factura' => $factura]);
        return response()->json(['error' => 'Error al procesar la factura', 'message' => $e->getMessage()]);
    }
}
public function subir_foto_lectura_dev(Request $request)
{
    $file_DB = DB::connection('mariadb')->table('Fotos_Lecto')->insertGetId([
        "cuenta" => $r->lectura,
        "ciclo" => $r->numero_cuenta,
        "ruta" => $r->id_usuario,
        "nombre_archivo" => $r->estado
    ]);

    // Validar que el archivo esté presente
    if (!$request->hasFile('zipfile')) {
        return response()->json(['error' => 'No file uploaded.'], 400);
    }

    $file = $request->file('zipfile');
    $filename = $file->getClientOriginalName();

    // Conexión SFTP
    $sftp = new \phpseclib3\Net\SFTP('192.168.1.21');
    if (!$sftp->login('root', 'Pinargote1986')) {
        return response()->json(['error' => 'Login Failed.'], 500);
    }

    // Subir archivo
    $contents = file_get_contents($file->getRealPath());
    if (!$sftp->put('/usr/share/nginx/html/lecturas/' . $filename, $contents)) {
        return response()->json(['error' => 'File upload failed.'], 500);
    }

    return response()->json(['message' => 'Se ha subido correctamente.'], 200);
}


    public function uploaddata(Request $request)
    {
        // Validar que el archivo esté presente
        if (!$request->hasFile('zipfile')) {
            return response()->json(['error' => 'No file uploaded.'], 400);
        }

        $file = $request->file('zipfile');
        $filename = $file->getClientOriginalName();

        // Conexión SFTP
        $sftp = new \phpseclib3\Net\SFTP('192.168.1.21');
        if (!$sftp->login('root', 'Pinargote1986')) {
            return response()->json(['error' => 'Login Failed.'], 500);
        }

        // Subir archivo
        $contents = file_get_contents($file->getRealPath());
        if (!$sftp->put('/usr/share/nginx/html/lecturas/' . $filename, $contents)) {
            return response()->json(['error' => 'File upload failed.'], 500);
        }

        return response()->json(['message' => 'Se ha subido correctamente.'], 200);
    }

    public function getControlCuenta(Request $request)
{
    try {
        $numeroCuenta = $request->input('numero_cuenta');
        if (!$numeroCuenta) {
            return response()->json(['error' => 'Parámetro numero_cuenta no proporcionado'], 400);
        }

        // Asegúrate de que esta consulta sea correcta para tu lógica de negocio
        $data = DB::connection('mariadb')->table('controlfactura')->where('numero_cuenta', $numeroCuenta)->get();
        return response()->json($data, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al obtener datos: ' . $e->getMessage()], 500);
    }
}
public function getud()
    {
        return response()->json(['mensaje' => 'Función getud llamada con éxito']);
    }
public function check(Request $request)
    {
        // Validar que el campo 'numero' esté presente
        $validatedData = $request->validate([
            'numero' => 'required|numeric',
        ]);

        // Verificar si el número es 1
        if ($request->input('numero') == 1) {
            Log::info('Número 1 recibido, procediendo al logeo.');
            return response()->json(["mensaje" => "Logeo"]);
        } else {
            return response()->json(["mensaje" => "Número recibido no es 1"]);
        }
    }
  public function sincronizarLecturasSoap2(Request $r)
  {

      try {
          // Verificar que todos los campos requeridos tengan valores
          if (empty($r->lectura) || empty($r->numero_cuenta) || empty($r->id_usuario)) {
              Log::error('Valores requeridos faltantes', ['request' => $r->all()]);
              return response()->json(["RES" => false, "MSG" => "Valores requeridos faltantes"]);
          }
  
          // Obtener la respuesta SOAP en formato base64
          $soapResponseBase64 = $r->soapwhrite;
  
          // Decodificar la respuesta de base64
          $soapResponse = base64_decode($soapResponseBase64);
  
          // Verificar si la decodificación fue exitosa
          if ($soapResponse === false) {
              // La decodificación falló, puedes manejar este caso de error aquí
              Log::error('Decodificación de base64 fallida', ['request' => $r->all()]);
              return response()->json(["RES" => false, "MSG" => "Decodificación de base64 fallida"]);
          }
  
          // Convertir el XML a una cadena
          $soapResponseStr = (string) simplexml_load_string($soapResponse);
  
          // Extraer el número del XML
          $numero = ''; // Inicializar como cadena vacía
          $xml = simplexml_load_string($soapResponseStr);
          if ($xml && isset($xml->resulcode)) {
              $numero = (string) $xml->resulcode;
          }
  
          // Insertar los datos en la base de datos
          $dis_usu = DB::connection('mariadb')->table('controlfactura')->insert([
              "lectura" => $r->lectura,
              "numero_cuenta" => $r->numero_cuenta,
              "id_usuario" => $r->id_usuario,
              "estado" => $r->estado,
              "soapwhrite" => $numero, // Almacenar solo el número en lugar del XML completo
              "soapread" => $r->soapread,
          ]);
  
          if ($dis_usu) {
              // Verificar el estado y hacer la llamada SOAP si es necesario
              if ($r->estado == 2) {
                  $wsdl = 'https://sw.portoaguas.gob.ec:443/PORTOAGUASEP/electrofacturacion?WSDL';
                  $mySoapClient = new SoapClient($wsdl, [
                      'cache_wsdl' => WSDL_CACHE_NONE,
                      'trace' => 1
                  ]);
  
                  $response = $mySoapClient->WSPROCESSEDWRITE([
                      'lectura' => $r->lectura,
                      'user' => 'admin',
                      'password' => 'admin'
                  ]);
  
                  // Convertir la respuesta SOAP a cadena (ajustar según la estructura de la respuesta)
                  $responseStr = $response->formato; // Aquí se extrae el valor "formato" de la respuesta SOAP
  
                  // Actualizar soapwhrite con el valor de "formato" y cambiar el estado a 3
                  DB::connection('mariadb')->table('controlfactura')
                      ->where('lectura', $r->lectura)
                      ->update(['estado' => 5, 'soapwhrite' => $responseStr]);


              }
  //wilsonssss
                 return response()->json($response->formato); // Retorna la respuesta base64
            } else {
              Log::warning('Inserción fallida', ['request' => $r->all()]); // Registro de fallo
              return response()->json(["RES" => false]);
          }
  
      } catch (\Exception $e) {
          Log::error('Error en sincronizarLecturas', ['error' => $e->getMessage(), 'request' => $r->all()]); // Registro de error
          return response()->json(["RES" => false, "MSG" => "Error interno del servidor"]);
      }
  }
 
  


    public function callSoapApiD($clave)
    {
        // Parámetros de la solicitud SOAP
        $tipo = 1;
    
        // URL del servicio SOAP
        $serviceUrl = 'http://192.168.1.218:8080/ServicesPortoaguas/services?WSDL';
    
        // Crear un cliente SOAP
        $client = new SoapClient($serviceUrl);
    
        // Crear un arreglo con los parámetros de la función SOAP
        $params = array(
            'tipo' => $tipo,
            'pass' => $clave, // Usar la contraseña pasada como argumento
        );
    
        try {
            // Llamar a la función SOAP
            $response = $client->DportoaguasC($params);
    
            // Verificar si la respuesta es válida y contiene la propiedad 'result'
            if (isset($response->result)) {
                // Obtener el resultado de la respuesta
                $result = $response->result;
    
                // Retornar solo el valor sin formato JSON
                return response($result, 200);
            } else {
                // La respuesta no es válida o no contiene la propiedad 'result'
                return response()->json(['error' => 'Respuesta SOAP no válida o estructura inesperada'], 500);
            }
        } catch (SoapFault $e) {
            // Manejar errores de la solicitud SOAP
            return response()->json(['error' => 'Error en la solicitud SOAP: ' . $e->getMessage()], 500);
        }
    }

    public function getClave($clave)
{
    $tipo = 1;
    $serviceUrl = 'http://192.168.1.218:8080/ServicesPortoaguas/services?WSDL';

    try {
        // Initialize the SOAP client directly without using InstanceSoapClient
        $client = new SoapClient($serviceUrl, [
            'cache_wsdl' => WSDL_CACHE_NONE
        ]);

        // Set parameters and make the SOAP request
        $params = [
            'tipo' => $tipo,
            'pass' => $clave,
        ];
        $response = $client->EportoaguasC($params);

        // Handle the response
        if (isset($response->result)) {
            return $response->result;
        } else {
            return json_encode(['error' => 'Respuesta SOAP no válida o estructura inesperada']);
        }
    } catch (SoapFault $e) {
        // Handle any exceptions
        return json_encode(['error' => 'Error en la solicitud SOAP: ' . $e->getMessage()]);
    }
}

    public function callSoapApi($clave)
    {
        $tipo = 1;
    
        $serviceUrl = 'http://192.168.1.218:8080/ServicesPortoaguas/services?WSDL';
    
        $client = new SoapClient($serviceUrl);
    
        $params = array(
            'tipo' => $tipo,
            'pass' => $clave, // Usar la contraseña pasada como argumento
        );
    
        try {
            $response = $client->EportoaguasC($params);
    
            // Verificar si la respuesta es válida y contiene la propiedad 'result'
            if (isset($response->result)) {
                // Obtener el resultado de la respuesta
                $result = $response->result;
    
                // Retornar solo el valor sin formato JSON
                return response($result, 200);
            } else {
                // La respuesta no es válida o no contiene la propiedad 'result'
                return response()->json(['error' => 'Respuesta SOAP no válida o estructura inesperada'], 500);
            }
        } catch (SoapFault $e) {
            // Manejar errores de la solicitud SOAP
            return response()->json(['error' => 'Error en la solicitud SOAP: ' . $e->getMessage()], 500);
        }
    }
    public function autenticacionWeb(Request $r)
{
    $clave = $this->getclave($r->clave);

    $users = DB::connection('mysql_aflow')->select("Select * from v_usuario_activo_2 where cedula = ?", [$r->usuario]);

    if (!empty($users)) {
        $rolSigopEncontrado = false;
        foreach ($users as $user) {
            if ($user->clave == $clave) {
                $r->session()->put('SESSION_ID', $user->DESCRIPCION);
                $r->session()->put('SESSION_CEDULA', $user->cedula);
                $r->session()->put('SESSION_CORREO', $user->correo);
                $r->session()->put('SESSION_USER', $user->nombres . ' ' . $user->apellidos);

                if ($user->id_rol == 'ROL_PL_SIGOP' || $user->id_rol == 'ROL_DESA') {
                    $rolSigopEncontrado = true;
                    $r->session()->put('SESSION_ROL', $user->id_rol);
                }
            }else{
                return response()->json(["message" => "Contraseña no es valida"], 401);

            }
        }

        if ($rolSigopEncontrado) {
            return response()->json(["message" => "Bienvenido", "redirectUrl" => 'home']);
        } else {
            return response()->json(["message" => "Bienvenido", "redirectUrl" => 'index2']);
        }
    } else {
        return response()->json(["message" => "Usuario no encontrado"], 401);
    }
}
public function autenticacionWeb2(Request $r)
{
    $clave = $this->getclave($r->clave);

    $users = DB::connection('mysql_aflow')->select("Select * from v_user_ap where  ID_USUARIO = ?", [$r->usuario]);

    if (!empty($users)) {
        $rolSigopEncontrado = false;
        foreach ($users as $user) {
            if ($user->clave == $clave) {
               // return $user;
                $r->session()->put('SESSION_ID', $user->col);
                $r->session()->put('SESSION_CEDULA', $user->ID_USUARIO);
                $r->session()->put('SESSION_USER', $user->NOMBRES);
                $r->session()->put('SESSION_ROL', $user->id_rol);

                if ($user->id_rol == 'ROL_FA_LECTO' || $user->id_rol == 'LECTO_FACTUR' || $user->id_rol == 'LECTO_SUPER') {
                    $rolSigopEncontrado = true;
                }
            }
        }

        if ($rolSigopEncontrado) {
            return response()->json(["message" => "Bienvenido", "redirectUrl" => route('facturas_datos')]);
        } else {
            return response()->json(["message" => "Bienvenido", "redirectUrl" => route('login')]);
        }
    } else {
        return response()->json(["message" => "Usuario no encontrado"], 401);
    }
}

public function enviarLecturas3()
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
            Log::error('Error al procesar la lectura', ['error' => $e->getMessage(), 'lectura' => $lectura->lectura]);
        }
    }

    return response()->json($responses); // Retorna un array con todas las respuestas base64
}


  public function enviarLecturasSonde()
  {
      // Obtener las lecturas
      $lecturas = DB::connection('mariadb')
          ->table('sondeo_CE')
          ->selectRaw('MAX(idControlFactura) as idControlFactura, lectura')
          ->where('estado', '10')
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
              Log::error('Error al procesar la lectura', ['error' => $e->getMessage(), 'lectura' => $lectura->lectura]);
          }
      }
  
      return response()->json($responses); // Retorna un array con todas las respuestas base64
  }
  
    public function obtenerInfoRuta($ciclo)
    {
        // Verificar si el número de ciclo fue proporcionado
        if (is_null($ciclo)) {
            return response()->json(['error' => 'Número de ciclo no proporcionado'], 400);
        }
    
        // Agregar el servicio
        SoapWrapper::add('portoaguas', function ($service) {
            $service
                ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
                ->trace(true)
                ->cache(WSDL_CACHE_NONE);
        });
    
        // Llamar al servicio
        $result = SoapWrapper::call('portoaguas.ciclo_r', ['ciclo' => $ciclo]);
    
        // Log the result to check the SOAP response
        // \Log::info($result);
    
        // Asegúrate de que la respuesta esté en UTF-8 antes de intentar decodificarla
        $result = mb_convert_encoding($result, 'UTF-8', 'auto');
    
        // Suponiendo que la información de la ruta es una cadena JSON, intenta decodificarla
        $rutaDataArray = json_decode($result, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            // \Log::error('JSON decode error: ' . json_last_error_msg());
            return response()->json(['error' => 'Error al decodificar la información de la ruta'], 500);
        }
    
        // Retorna la información de la ruta como una respuesta JSON
        return response()->json($rutaDataArray);
    }



    public function rutasxcuentaXML($ruta)
    {
        // Verificar si el número de ruta fue proporcionado
        if (is_null($ruta)) {
            return response()->json(['error' => 'Número de ciclo no proporcionado'], 400);
        }
    
        // Agregar el servicio
        SoapWrapper::add('portoaguas', function ($service) {
            $service
                ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
                ->trace(true)
                ->cache(WSDL_CACHE_NONE);
        });
    
        // Llamar al servicio
        $result = SoapWrapper::call('portoaguas.cuentas_cec_xruta', ['ruta' => $ruta]);
    
        // Log the result to check the SOAP response
        // \Log::info($result);
    
        // Asegúrate de que la respuesta esté en UTF-8 antes de intentar decodificarla
        $result = mb_convert_encoding($result, 'UTF-8', 'auto');
    
        // Suponiendo que la información de la ruta es una cadena JSON, intenta decodificarla
        $rutaDataArray = json_decode($result, true);
    
        // Verifica si $rutaDataArray contiene los datos
    if (!is_array($rutaDataArray) || empty($rutaDataArray)) {
        return response()->json(['error' => 'No se encontraron datos para la ruta proporcionada'], 404);
    }

    // Crear una instancia de SimpleXMLElement
    $xml = new SimpleXMLElement('<lecturas/>');

    // Recorre cada registro en el array
    foreach ($rutaDataArray as $registro) {
        $lectura = $xml->addChild('lectura');

        // Agrega los elementos al XML con los datos del JSON
        $lectura->addChild('ordenLectura', '35941'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('periodo', $registro['SIG_CICLO']);
        $lectura->addChild('cuentaContrato', $registro['NUMERO_CUENTA']);
        $lectura->addChild('tipoEnvio', '01'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('codigoObservacion', '');
        $lectura->addChild('codigoNovedadCons', '0035'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('observacionAlfanumerica', '');
        $lectura->addChild('claseLectura', '01'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('lecturaActual', 'NULL'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('consumo', $registro['CONSUMO']);
        $lectura->addChild('fechaLecturaActual', '2023126'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('horaLecturaActual', '221922'); // Valor estático, ajusta según sea necesario
        $fotografias = $lectura->addChild('fotografias');
        $fotografias->addChild('foto', '61_00020230710484355468_0000000002558541_202006_133831.jpg'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('idLector', $registro['NUMERO_IDENTIFICACION']);
        $lectura->addChild('idPredio', $registro['CODIGO_PREDIO']);
        $lectura->addChild('tipoServicio', $registro['CODIGO_TIPO_SERVICIO']);
        $lectura->addChild('coordUTM_X', $registro['LONGITUD']);
        $lectura->addChild('coordUTM_Y', $registro['LATITUD']);
        $lectura->addChild('idMedidor', $registro['CODIGO_MEDIDOR']);
        $lectura->addChild('catastro', '0'); // Valor estático, ajusta según sea necesario
    }

    // Convertir el objeto SimpleXMLElement a una cadena XML
    $xmlString = $xml->asXML();

    // Retorna la información en formato XML
    return response($xmlString, 200)->header('Content-Type', 'text/xml');
}
public function rutasxcuenta($ruta)
{  
    $datosSesion = session()->all();
           
    $usuarioSesion = [
        'SESSION_ID' => session('SESSION_ID'),
        'SESSION_CEDULA' => session('SESSION_CEDULA'),
        'SESSION_USER' => session('SESSION_USER'),
    ];
    date_default_timezone_set('America/Guayaquil');
    $fechaActual = date('Ym');
    $fechaActualD = date('Ymd');
    $fechaActualH = date('His');

    // Verificar si el número de ruta fue proporcionado
    if (is_null($ruta)) {
        return response()->json(['error' => 'Número de ciclo no proporcionado'], 400);
    }

    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.cuentas_cec_xruta', ['ruta' => $ruta]);

    // Asegúrate de que la respuesta esté en UTF-8 antes de intentar decodificarla
    $result = mb_convert_encoding($result, 'UTF-8', 'auto');

    // Suponiendo que la información de la ruta es una cadena JSON, intenta decodificarla
    $rutaDataArray = json_decode($result, true);

    // Verifica si $rutaDataArray contiene los datos
    if (!is_array($rutaDataArray) || empty($rutaDataArray)) {
        return response()->json(['error' => 'No se encontraron datos para la ruta proporcionada'], 404);
    }

    // Crear una instancia de SimpleXMLElement
    $xml = new SimpleXMLElement('<lecturas/>');

    // Recorre cada registro en el array
    foreach ($rutaDataArray as $registro) {
        $lectura = $xml->addChild('lecturas');

        // Agrega los elementos al XML con los datos del JSON
        $lectura->addChild('ordenLectura', '35941'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('periodo', $fechaActual);
        $lectura->addChild('cuentaContrato', $registro['NUMERO_CUENTA']);
        $lectura->addChild('tipoEnvio', '01'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('codigoObservacion', '');
        $lectura->addChild('codigoNovedadCons', ''); // Valor estático, ajusta según sea necesario
        $lectura->addChild('observacionAlfanumerica', '');
        $lectura->addChild('claseLectura', '01'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('lecturaActual', 'NULL'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('consumo', $registro['CONSUMO']);
        $lectura->addChild('fechaLecturaActual', $fechaActualD); // Valor estático para el ejemplo
        $lectura->addChild('horaLecturaActual' , $fechaActualH); // Valor estático para el ejemplo
        $fotografias = $lectura->addChild('fotografias');
        $fotografias->addChild('foto', '61_00020230710484355468_0000000002558541_202006_133831.jpg'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('idLector', '6030');
        $lectura->addChild('idPredio', $registro['CODIGO_PREDIO']);
        $lectura->addChild('tipoServicio', $registro['CODIGO_TIPO_SERVICIO']);
        $lectura->addChild('coordUTM_X', $registro['LONGITUD']);
        $lectura->addChild('coordUTM_Y', $registro['LATITUD']);
        $lectura->addChild('idMedidor', $registro['CODIGO_MEDIDOR']);
        $lectura->addChild('catastro', '0'); // Valor estático, ajusta según sea necesario
    

        // Convertir cada lectura a una cadena XML
        $lecturaXmlString = $lectura->asXML();

        // Codificar en Base64
        $lecturaBase64 = base64_encode($lecturaXmlString);

        // Insertar en la base de datos
        DB::connection('mariadb')->table('sondeo_CE')->insert([
            "lectura" => $lecturaBase64,
            "numero_cuenta" => $registro['NUMERO_CUENTA'],
            "id_usuario" => session('SESSION_CEDULA'), 
        ]);
    }
    return response()->json(true, 200);

    // Retorna la información en formato XML
   // return response($xml->asXML(), 200)->header('Content-Type', 'text/xml');
}
public function rutasxcuentaPromedio($ruta, $observacion)
{  date_default_timezone_set('America/Guayaquil');
    $fechaActual = date('Ym');
    $fechaActualD = date('Ymd');
    $fechaActualH = date('His');

    // Verificar si el número de ruta fue proporcionado
    if (is_null($ruta)) {
        return response()->json(['error' => 'Número de ciclo no proporcionado'], 400);
    }

    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.cuentas_cp_xruta', ['ruta' => $ruta]);

    // Asegúrate de que la respuesta esté en UTF-8 antes de intentar decodificarla
    $result = mb_convert_encoding($result, 'UTF-8', 'auto');

    // Suponiendo que la información de la ruta es una cadena JSON, intenta decodificarla
    $rutaDataArray = json_decode($result, true);

    // Verifica si $rutaDataArray contiene los datos
    if (!is_array($rutaDataArray) || empty($rutaDataArray)) {
        return response()->json(['error' => 'No se encontraron datos para la ruta proporcionada'], 404);
    }

    // Crear una instancia de SimpleXMLElement
    $xml = new SimpleXMLElement('<lecturas/>');

    // Recorre cada registro en el array
    foreach ($rutaDataArray as $registro) {
        $lectura = $xml->addChild('lecturas');

        // Agrega los elementos al XML con los datos del JSON LECTURA ANTERIOR MAS EL CONSUMO
        // ULTIMA_LECTURA + CONSUMO_PROMEDIO
        $lectura->addChild('ordenLectura', '35941'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('periodo', $fechaActual);
        $lectura->addChild('cuentaContrato', $registro['NUMERO_CUENTA']);
        $lectura->addChild('tipoEnvio', '01'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('codigoObservacion', '');
        $lectura->addChild('codigoNovedadCons', '0035'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('observacionAlfanumerica', htmlspecialchars($observacion)); // Añadir la observación aquí
        $lectura->addChild('claseLectura', '01'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('lecturaActual',  $registro['ULTIMA_LECTURA']+$registro['CONSUMO_PROMEDIO']); // Valor estático, ajusta según sea necesario
        $lectura->addChild('consumo', $registro['CONSUMO']);
        $lectura->addChild('fechaLecturaActual', $fechaActualD); // Valor estático para el ejemplo
        $lectura->addChild('horaLecturaActual' , $fechaActualH); // Valor estático para el ejemplo
        $fotografias = $lectura->addChild('fotografias');
        $fotografias->addChild('foto', '61_00020230710484355468_0000000002558541_202006_133831.jpg'); // Valor estático, ajusta según sea necesario
        $lectura->addChild('idLector', '6030');
        $lectura->addChild('idPredio', $registro['CODIGO_PREDIO']);
        $lectura->addChild('tipoServicio', $registro['CODIGO_TIPO_SERVICIO']);
        $lectura->addChild('coordUTM_X', $registro['LONGITUD']);
        $lectura->addChild('coordUTM_Y', $registro['LATITUD']);
        $lectura->addChild('idMedidor', $registro['CODIGO_MEDIDOR']);
        $lectura->addChild('catastro', '0'); // Valor estático, ajusta según sea necesario
    

        // Convertir cada lectura a una cadena XML
        $lecturaXmlString = $lectura->asXML();

        // Codificar en Base64
        $lecturaBase64 = base64_encode($lecturaXmlString);

     

        // Insertar en la base de datos
       DB::connection('mariadb')->table('sondeo_CE')->insert([
            "lectura" => $lecturaBase64,
            "numero_cuenta" => $registro['NUMERO_CUENTA'],
            "id_usuario" => session('SESSION_CEDULA'), 
        ]);
    }
    return response()->json(true, 200);

    // Retorna la información en formato XML
   // return response($xml->asXML(), 200)->header('Content-Type', 'text/xml');
}
public function rutasxcuentaPromedioCuenta(Request $request)
{
    $ruta = $request->input('ruta');
    $numerosCuenta = explode(',', $request->input('numerocuenta'));
    $observacion = $request->input('observacion');

    date_default_timezone_set('America/Guayaquil');
    $fechaActual = date('Ym');
    $fechaActualD = date('Ymd');
    $fechaActualH = date('His');

    if (is_null($ruta)) {
        return response()->json(['error' => 'Número de ciclo no proporcionado'], 400);
    }

    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    $result = SoapWrapper::call('portoaguas.cuentas_cp_xruta', ['ruta' => $ruta]);
    $result = mb_convert_encoding($result, 'UTF-8', 'auto');
    $rutaDataArray = json_decode($result, true);

    $xml = new SimpleXMLElement('<lecturas/>');

    foreach ($numerosCuenta as $numerocuenta) {
        $numerocuenta = trim($numerocuenta);

        $rutaDataFiltrada = array_filter($rutaDataArray, function ($registro) use ($numerocuenta) {
            return $registro['NUMERO_CUENTA'] == $numerocuenta;
        });

        foreach ($rutaDataFiltrada as $registro) {
            $lectura = $xml->addChild('lecturas');
            $lectura->addChild('ordenLectura', '35941');
            $lectura->addChild('periodo', $fechaActual);
            $lectura->addChild('cuentaContrato', $numerocuenta);
            $lectura->addChild('tipoEnvio', '01');
            $lectura->addChild('codigoObservacion', '');
            $lectura->addChild('codigoNovedadCons', '0035');
            $lectura->addChild('observacionAlfanumerica', $observacion);
            $lectura->addChild('claseLectura', '01');
            $lectura->addChild('lecturaActual',  $registro['ULTIMA_LECTURA']+$registro['CONSUMO_PROMEDIO']);
            $lectura->addChild('consumo', $registro['CONSUMO']);
            $lectura->addChild('fechaLecturaActual', $fechaActualD);
            $lectura->addChild('horaLecturaActual', $fechaActualH);
            $fotografias = $lectura->addChild('fotografias');
            $fotografias->addChild('foto', '61_00020230710484355468_0000000002558541_202006_133831.jpg');
            $lectura->addChild('idLector', '6030');
            $lectura->addChild('idPredio', $registro['CODIGO_PREDIO']);
            $lectura->addChild('tipoServicio', $registro['CODIGO_TIPO_SERVICIO']);
            $lectura->addChild('coordUTM_X', $registro['LONGITUD']);
            $lectura->addChild('coordUTM_Y', $registro['LATITUD']);
            $lectura->addChild('idMedidor', $registro['CODIGO_MEDIDOR']);
            $lectura->addChild('catastro', '0');

            $lecturaXmlString = $lectura->asXML();
            $lecturaBase64 = base64_encode($lecturaXmlString);

            DB::connection('mariadb')->table('sondeo_CE')->insert([
                "lectura" => $lecturaBase64,
                "numero_cuenta" => $registro['NUMERO_CUENTA'],
                "id_usuario" => session('SESSION_CEDULA'), 
            ]);
        }
    }

    return response()->json(true, 200);
}

//prueba eliminar 7/12/2023
    public function procesarDatosRuta($ruta)
{
    $datosJson = $this->rutasxcuenta($ruta); // Suponiendo que esto devuelve los datos JSON
    $datos = json_decode($datosJson, true);

    foreach ($datos as $dato) {
        $xml = $this->convertirAxml($dato);
        $xmlBase64 = base64_encode($xml);

        // Inserta el XML codificado en Base64 en la base de datos
       
         DB::connection('mariadb')->table('sondeo_CE')->insert([
            "lectura" => $xmlBase64,
            "numero_cuenta" => '',
            "id_usuario" => '',
            "estado" => '',
            "soapwhrite" => '',
            "soapread" => '',
        ]);
    }
}

private function convertirAxml($dato)
{
    $xml = new SimpleXMLElement('<lecturas/>');
    
    $xml->addChild('ordenLectura', '35941'); // Valor estático para el ejemplo
    $xml->addChild('periodo', $dato['SIG_CICLO']); // año
    $xml->addChild('cuentaContrato', $dato['NUMERO_CUENTA']);
    $xml->addChild('tipoEnvio', '01'); // Valor estático para el ejemplo
    $xml->addChild('codigoObservacion', ''); // Valor estático para el ejemplo
    $xml->addChild('codigoNovedadCons', '0035'); // Valor estático para el ejemplo
    $xml->addChild('observacionAlfanumerica', ''); // Valor estático para el ejemplo
    $xml->addChild('claseLectura', '01'); // Valor estático para el ejemplo
    $xml->addChild('lecturaActual', 'NULL'); // Valor estático para el ejemplo
    $xml->addChild('consumo', $dato['CONSUMO']);
    $xml->addChild('fechaLecturaActual', '2023126'); // Valor estático para el ejemplo
    $xml->addChild('horaLecturaActual', '221922'); // Valor estático para el ejemplo
    
    $fotografias = $xml->addChild('fotografias');
    $fotografias->addChild('foto', '61_00020230710484355468_0000000002558541_202006_133831.jpg'); // Valor estático para el ejemplo

    $xml->addChild('idLector', $dato['NUMERO_IDENTIFICACION']);
    $xml->addChild('idPredio', $dato['CODIGO_PREDIO']);
    $xml->addChild('tipoServicio', $dato['CODIGO_TIPO_SERVICIO']);
    $xml->addChild('coordUTM_X', $dato['LONGITUD']);
    $xml->addChild('coordUTM_Y', $dato['LATITUD']);
    $xml->addChild('idMedidor', $dato['CODIGO_MEDIDOR']);
    $xml->addChild('catastro', '0'); // Valor estático para el ejemplo

    return $xml->asXML();
}
    public function obtenerCuentasPorRuta($ciclo)
{
    // Verificar si el número de ciclo fue proporcionado
    if (is_null($ciclo)) {
        return response()->json(['error' => 'Número de ciclo no proporcionado'], 400);
    }

    // Agregar el servicio1310371859
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.cuentas_x_ciclo', ['ciclo' => $ciclo]); // Cambiado a cuentas_x_ciclo


    $result = mb_convert_encoding($result, 'UTF-8', 'auto');

    // Suponiendo que la información de las cuentas es una cadena JSON, intenta decodificarla
    $cuentasDataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
       //  \Log::error('JSON decode error: ' . json_last_error_msg());
        return response()->json(['error' => 'Error al decodificar la información de las cuentas'], 500);
    }

    // Retorna la información de las cuentas como una respuesta JSON
    return response()->json($cuentasDataArray);
}
public function obtenerCuentasPorRutaprueba($ciclo)
{
    if (is_null($ciclo)) {
        return response()->json(['error' => 'Número de ciclo no proporcionado'], 400);
    }

    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    $result = SoapWrapper::call('portoaguas.cuentas_x_ciclo', ['ciclo' => $ciclo]);
    $result = mb_convert_encoding($result, 'UTF-8', 'auto');

    $cuentasDataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return response()->json(['error' => 'Error al decodificar la información de las cuentas'], 500);
    }

    $cuentasValidas = [];
    foreach ($cuentasDataArray as $cuenta) {
        try {
            // Procesar cada cuenta aquí.
            // Si la cuenta es válida, añadirla a la lista de cuentasValidas.
            $cuentasValidas[] = $cuenta;
        } catch (\Exception $e) {
            // Manejar el error de la cuenta individual.
            // Puedes registrar el error o hacer algo con él.
            \Log::error("Error procesando cuenta: " . $e->getMessage());
            // No añadir esta cuenta a cuentasValidas.
        }
    }

    return response()->json($cuentasValidas);
}



public function getModeloOsi(Request $r)
{
    try {
        
        // Seleccionar todos los registros de la tabla 'modelo_osi'
        $registros = DB::connection('mariadb')->table('modelo_osi')->get();

        if ($registros) {
            return response()->json($registros);
        } else {
            Log::warning('Consulta fallida en getModeloOsi', ['request' => $r->all()]); // Log de fallo
            return response()->json([]);
        }
    } catch (\Exception $e) {
        Log::error('Error en getModeloOsi', ['error' => $e->getMessage(), 'request' => $r->all()]); // Log de error
        return response()->json(["MSG" => "Error interno del servidor"]);
    }
}

//LECTO FACTURACION 




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
                'soapwhrite' => $response->formato
            ]);

        return response()->json($response->formato); // Retorna la respuesta base64

    } catch (\Exception $e) {
        // Registrar el error
        Log::error('Error al procesar la lectura', ['error' => $e->getMessage(), 'lectura' => $lecturaData]);
        return response()->json(["error" => "Error al procesar la lectura."], 500);
    }
}


public function enviarLecturasPorCuenta2(Request $r)
{
    // Obtener la variable 'lectura' y 'idControlFactura' del Request
    $lecturaData = $r->input('lectura');
    $numero_cuenta = $r->input('numero_cuenta');
    $id_usuario = $r->input('id_usuario');
    $estado = $r->input('estado');
    $soapwhrite = $r->input('soapwhrite');
    $soapread = $r->input('soapread');

    if (!$lecturaData) {
        return response()->json(["error" => "La lectura es requerida."], 400);
    }

 // Insertar los datos en la base de datos
 DB::connection('mariadb')->table('controlfactura')->insert([
    "lectura" => $r->lecturaData,
    "numero_cuenta" => $r->numero_cuenta,
    "id_usuario" => $r->id_usuario,
    "estado" => $r->estado,
    "soapwhrite" => $soapwhrite, // Almacenar solo el número en lugar del XML completo
    "soapread" => $r->soapread,
]);

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


        return response()->json($response->formato); // Retorna la respuesta base64

        DB::connection('mariadb')->table('controlfactura')
        ->where('lectura', $r->lecturaData)
        ->update(['estado' => 5, 'soapwhrite' => $formato]);

    } catch (\Exception $e) {
        // Registrar el error
        Log::error('Error al procesar la lectura', ['error' => $e->getMessage(), 'lectura' => $lecturaData]);
        return response()->json(["error" => "Error al procesar la lectura."], 500);
    }
}




public function cuentasfull()
{
    $data = [];
    
    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.cuentasfull', [$data]);

    // Registrar la respuesta original del servicio SOAP
    // \Log::info('Respuesta SOAP original: ' . $result);

    // Verificar si hay caracteres no imprimibles y asegurar que la cadena esté en UTF-8
    $result = preg_replace('/[[:^print:]]/', '', $result);
    $result = utf8_encode($result);

    // Intenta decodificar la cadena JSON directamente
    $dataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // \Log::error('JSON decode error: ' . json_last_error_msg());
        return response()->json([]);  // Devuelve una respuesta JSON vacía en caso de error
    }

    // No hay transformación de datos aquí, ya que no especificaste ninguna

    return response()->json($dataArray);  // Devuelve una respuesta JSON con los datos del impedimento
}

public function facturas_datos2(){
  
    return view('Factura.factursc'); // Usar $filteredData en lugar de $data
}
public function facturas_datos(Request $request){
    $numero_cuenta = $request->get('numero_cuenta');
  
    $subQuery = DB::connection('mariadb')
    ->table('controlfactura')
    ->selectRaw('MAX(idControlFactura) as id, numero_cuenta as cuenta')
    ->where('estado', '!=', 9) // Condición de estado=2
    ->groupBy('numero_cuenta');

$subQuerySql = $subQuery->toSql();
$subQueryBindings = $subQuery->getBindings();

$data = DB::connection('mariadb')
    ->table(DB::raw("($subQuerySql) as b"))
    ->mergeBindings($subQuery) // ¡Importante! Fusiona los parámetros de la subconsulta
    ->join('controlfactura as a', 'a.idControlFactura', '=', 'b.id')
    ->select('a.idControlFactura', 'a.numero_cuenta', 'a.lectura', 'a.estado', 'a.soapwhrite', 'a.id_usuario')
    ->where('a.estado', '!=', 9); // Condición de estado=4

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
            if ($codigoSoapwhrite != '80000' && $codigoSoapwhrite != '90000'&& $codigoSoapwhrite != '80807') {
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
  
    return view('Factura.factura', ['data' => $filteredData]); // Usar $filteredData en lugar de $data
}

public function facturas_reales(Request $request){
  $numero_cuenta = $request->get('numero_cuenta');

  $subQuery = DB::connection('mariadb')
  ->table('controlfactura')
  ->selectRaw('MAX(idControlFactura) as id, numero_cuenta as cuenta')
  ->where('estado', '!=', 9) // Condición de estado=2
  ->groupBy('numero_cuenta');

$subQuerySql = $subQuery->toSql();
$subQueryBindings = $subQuery->getBindings();

$data = DB::connection('mariadb')
  ->table(DB::raw("($subQuerySql) as b"))
  ->mergeBindings($subQuery) // ¡Importante! Fusiona los parámetros de la subconsulta
  ->join('controlfactura as a', 'a.idControlFactura', '=', 'b.id')
  ->select('a.idControlFactura', 'a.numero_cuenta', 'a.lectura', 'a.estado', 'a.soapwhrite', 'a.id_usuario')
  ->where('a.estado', '!=', 9); // Condición de estado=4

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


public function enviarLecturas2()
{
  // Obtener las lecturas
  $lecturas = DB::connection('mariadb')
      ->table('controlfactura')
      ->selectRaw('MAX(idControlFactura) as idControlFactura, lectura')
      ->where('estado', 2)
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



    public function obtenerCodigos_Ciclos()
    {
        $data = [];
    
        // Agregar el servicio
        SoapWrapper::add('portoaguas', function ($service) {
            $service
                ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
                ->trace(true)
                ->cache(WSDL_CACHE_NONE);
        });
    
        // Llamar al servicio
        $result = SoapWrapper::call('portoaguas.ciclo_f', [$data]);
    
        // Verificar si hay caracteres no imprimibles y asegurar que la cadena esté en UTF-8
        $result = preg_replace('/[[:^print:]]/', '', $result);
        $result = utf8_encode($result);
    
        // Intenta decodificar la cadena JSON directamente
        $dataArray = json_decode($result, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
          //   \Log::error('JSON decode error: ' . json_last_error_msg());
            return response()->json([]);  // Devuelve una respuesta JSON vacía en caso de error
        }
    
        foreach ($dataArray as &$item) {
            $item['ciclo'] = $item['descripcion'];
            unset($item['descripcion']);
        }
    
        return response()->json($dataArray);  // Devuelve una respuesta JSON con los datos de los ciclos
    }
    public function obtenerImpedimento()
{
    $data = [];
    
    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.impedimento', [$data]);

    // Verificar si hay caracteres no imprimibles y asegurar que la cadena esté en UTF-8
    $result = preg_replace('/[[:^print:]]/', '', $result);
    $result = utf8_encode($result);

    // Intenta decodificar la cadena JSON directamente
    $dataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
       //  \Log::error('JSON decode error: ' . json_last_error_msg());
        return response()->json([]);  // Devuelve una respuesta JSON vacía en caso de error
    }

    // No hay transformación de datos aquí, ya que no especificaste ninguna

    return response()->json($dataArray);  // Devuelve una respuesta JSON con los datos del impedimento
}

public function cc_x_rutas()
{
    $data = [];
    
    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.rcr_cantidad', [$data]);

    // Verificar si hay caracteres no imprimibles y asegurar que la cadena esté en UTF-8
    $result = preg_replace('/[[:^print:]]/', '', $result);
    $result = utf8_encode($result);

    // Intenta decodificar la cadena JSON directamente
    $dataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
       //  \Log::error('JSON decode error: ' . json_last_error_msg());
        return response()->json([]);  // Devuelve una respuesta JSON vacía en caso de error
    }

    // No hay transformación de datos aquí, ya que no especificaste ninguna

    return response()->json($dataArray);  // Devuelve una respuesta JSON con los datos del impedimento
}

public function cc_x_rutasLecto2()
{
    $data = [];
    
    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.rcr_cantidads', [$data]);

    // Verificar si hay caracteres no imprimibles y asegurar que la cadena esté en UTF-8
    $result = preg_replace('/[[:^print:]]/', '', $result);
    $result = utf8_encode($result);

    // Intenta decodificar la cadena JSON directamente
    $dataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
       //  \Log::error('JSON decode error: ' . json_last_error_msg());
        return response()->json([]);  // Devuelve una respuesta JSON vacía en caso de error
    }

    // No hay transformación de datos aquí, ya que no especificaste ninguna

    return response()->json($dataArray);  // Devuelve una respuesta JSON con los datos del impedimento
}
public function obtenerObservacion()
{
    $data = [];
    
    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.observacion', [$data]);

    // Registrar la respuesta original del servicio SOAP
    // \Log::info('Respuesta SOAP original: ' . $result);

    // Verificar si hay caracteres no imprimibles y asegurar que la cadena esté en UTF-8
    $result = preg_replace('/[[:^print:]]/', '', $result);
    $result = utf8_encode($result);

    // Intenta decodificar la cadena JSON directamente
    $dataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // \Log::error('JSON decode error: ' . json_last_error_msg());
        return response()->json([]);  // Devuelve una respuesta JSON vacía en caso de error
    }

    // No hay transformación de datos aquí, ya que no especificaste ninguna

    return response()->json($dataArray);  // Devuelve una respuesta JSON con los datos del impedimento
}

public function rutastotales()
{
    $data = [];
    
    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.c_x_rutas', [$data]);

    // Registrar la respuesta original del servicio SOAP
    // \Log::info('Respuesta SOAP original: ' . $result);

    // Verificar si hay caracteres no imprimibles y asegurar que la cadena esté en UTF-8
    $result = preg_replace('/[[:^print:]]/', '', $result);
    $result = utf8_encode($result);

    // Intenta decodificar la cadena JSON directamente
    $dataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // \Log::error('JSON decode error: ' . json_last_error_msg());
        return response()->json([]);  // Devuelve una respuesta JSON vacía en caso de error
    }

    // No hay transformación de datos aquí, ya que no especificaste ninguna

    return response()->json($dataArray);  // Devuelve una respuesta JSON con los datos del impedimento
}
public function rutastotalesE()
{
    $data = [];
    
    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.cuentas_cec_xruta', [$data]);

    // Registrar la respuesta original del servicio SOAP
    // \Log::info('Respuesta SOAP original: ' . $result);

    // Verificar si hay caracteres no imprimibles y asegurar que la cadena esté en UTF-8
    $result = preg_replace('/[[:^print:]]/', '', $result);
    $result = utf8_encode($result);

    // Intenta decodificar la cadena JSON directamente
    $dataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // \Log::error('JSON decode error: ' . json_last_error_msg());
        return response()->json([]);  // Devuelve una respuesta JSON vacía en caso de error
    }

    // No hay transformación de datos aquí, ya que no especificaste ninguna

    return response()->json($dataArray);  // Devuelve una respuesta JSON con los datos del impedimento
}
public function rutastotalesPromedio()
{
    $data = [];
    
    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.c_x_rutas', [$data]);

    // Registrar la respuesta original del servicio SOAP
    // \Log::info('Respuesta SOAP original: ' . $result);

    // Verificar si hay caracteres no imprimibles y asegurar que la cadena esté en UTF-8
    $result = preg_replace('/[[:^print:]]/', '', $result);
    $result = utf8_encode($result);

    // Intenta decodificar la cadena JSON directamente
    $dataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // \Log::error('JSON decode error: ' . json_last_error_msg());
        return response()->json([]);  // Devuelve una respuesta JSON vacía en caso de error
    }

    // No hay transformación de datos aquí, ya que no especificaste ninguna

    return response()->json($dataArray);  // Devuelve una respuesta JSON con los datos del impedimento
}

public function rutastotalesPromedio2()
{
    $data = [];
    
    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.cc_x_rutasp', [$data]);

    // Registrar la respuesta original del servicio SOAP
    // \Log::info('Respuesta SOAP original: ' . $result);

    // Verificar si hay caracteres no imprimibles y asegurar que la cadena esté en UTF-8
    $result = preg_replace('/[[:^print:]]/', '', $result);
    $result = utf8_encode($result);

    // Intenta decodificar la cadena JSON directamente
    $dataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // \Log::error('JSON decode error: ' . json_last_error_msg());
        return response()->json([]);  // Devuelve una respuesta JSON vacía en caso de error
    }

    // No hay transformación de datos aquí, ya que no especificaste ninguna

    return response()->json($dataArray);  // Devuelve una respuesta JSON con los datos del impedimento
}

public function rutastotalesEstimado()
{
    $data = [];
    
    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.cc_x_rutas', [$data]);

    // Registrar la respuesta original del servicio SOAP
    // \Log::info('Respuesta SOAP original: ' . $result);

    // Verificar si hay caracteres no imprimibles y asegurar que la cadena esté en UTF-8
    $result = preg_replace('/[[:^print:]]/', '', $result);
    $result = utf8_encode($result);

    // Intenta decodificar la cadena JSON directamente
    $dataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // \Log::error('JSON decode error: ' . json_last_error_msg());
        return response()->json([]);  // Devuelve una respuesta JSON vacía en caso de error
    }

    // No hay transformación de datos aquí, ya que no especificaste ninguna

    return response()->json($dataArray);  // Devuelve una respuesta JSON con los datos del impedimento
}
public function rutastotalesR()
{
    $data = [];
    
    // Agregar el servicio
    SoapWrapper::add('portoaguas', function ($service) {
        $service
            ->wsdl('http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl')
            ->trace(true)
            ->cache(WSDL_CACHE_NONE);
    });

    // Llamar al servicio
    $result = SoapWrapper::call('portoaguas.cc_x_rutasp', [$data]);

    // Registrar la respuesta original del servicio SOAP
    // \Log::info('Respuesta SOAP original: ' . $result);

    // Verificar si hay caracteres no imprimibles y asegurar que la cadena esté en UTF-8
    $result = preg_replace('/[[:^print:]]/', '', $result);
    $result = utf8_encode($result);

    // Intenta decodificar la cadena JSON directamente
    $dataArray = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // \Log::error('JSON decode error: ' . json_last_error_msg());
        return response()->json([]);  // Devuelve una respuesta JSON vacía en caso de error
    }

    // No hay transformación de datos aquí, ya que no especificaste ninguna

    return response()->json($dataArray);  // Devuelve una respuesta JSON con los datos del impedimento
}

public function sincronizarLecturas(Request $r)
{
  $dis_usu = DB::connection('mariadb')->table('control')->insert([
    "nombre" => $r->nombre
  ]);
  if (json_encode($dis_usu) == true) {
    return response()->json(["RES" => true]);
  } else {
    return response()->json(["RES" => false]);
  }
}


}
