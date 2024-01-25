<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use phpseclib3\Net\SFTP;
use SoapWrapper;
use SoapClient;
use Illuminate\Support\Facades\DB;


class ColaSincronizacion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data; // Definir la propiedad data

    public function __construct(array $data) // Asegurar que el constructor acepte un array
    {
        $this->data = $data; // Asignar el valor de data
    }

    public function handle()
    {
        $r = (object) $this->data; // Convertir el array a objeto para un acceso más fácil
    
        try {
            // Verificar que todos los campos requeridos tengan valores
            if (empty($r->lectura) || empty($r->numero_cuenta) || empty($r->id_usuario)) {
                Log::error('Valores requeridos faltantes', ['request' => $r->all()]);
                return; // Terminar la ejecución del Job si faltan valores
            }
    
            // Obtener la respuesta SOAP en formato base64
            $soapResponseBase64 = $r->soapwhrite;
    
            // Decodificar la respuesta de base64
            $soapResponse = base64_decode($soapResponseBase64);
    
            // Verificar si la decodificación fue exitosa
            if ($soapResponse === false) {
                Log::error('Decodificación de base64 fallida', ['request' => $r->all()]);
                return; // Terminar la ejecución del Job si la decodificación falla
            }
    
            // Convertir el XML a una cadena
            $soapResponseStr = (string) simplexml_load_string($soapResponse);
    
            // Extraer el número del XML
            $numero = ''; // Inicializar como cadena vacía
            $xml = simplexml_load_string($soapResponseStr);
            if ($xml && isset($xml->resulcode)) {
                $numero = (string) $xml->resulcode;
            }
    
            /*if($numero == ''){
                $r->estado = 5;
            }*/
            // Insertar los datos en la base de datos
            $dis_usu = DB::connection('mariadb')->table('controlfactura')->insert([
                "lectura" => $r->lectura,
                "numero_cuenta" => $r->numero_cuenta,
                "id_usuario" => $r->id_usuario,
                "estado" => $r->estado,
                "soapwhrite" => $numero, // Almacenar solo el número en lugar del XML completo
                "soapread" => $r->soapread,
            ]);
    
            if ($dis_usu && $r->estado == 2) {
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
    
                // Convertir la respuesta SOAP a cadena
                $responseStr = $response->formato; // Extraer el valor "formato" de la respuesta SOAP
    
                // Actualizar soapwhrite con el valor de "formato" y cambiar el estado a 3
                DB::connection('mariadb')->table('controlfactura')
                    ->where('lectura', $r->lectura)
                    ->update(['estado' => 5, 'soapwhrite' => $responseStr]);
            }
        } catch (\Exception $e) {
            Log::error('Error en sincronizarLecturas', ['error' => $e->getMessage(), 'request' => $r->all()]);
        }
    }
    
}
