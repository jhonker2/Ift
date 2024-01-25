<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use SoapClient;
use Illuminate\Support\Facades\DB;

class SoaplecturaController extends Controller
{
    private $wsdl = 'https://sw.portoaguas.gob.ec/PORTOAGUASEP/electrofacturacion?WSDL';
    private $options = [
        'trace' => true,
        'cache_wsdl' => WSDL_CACHE_NONE,
        'exceptions' => true,
    ];
    
public function enviarLectura($lectura)
{
if (is_null($lectura)) {
    return response()->json(['error' => 'Lectura no proporcionada'], 400);
}

$client = new SoapClient($this->wsdl, $this->options);

$params = [
    'lectura' => $lectura,
    'user' => 'admin',
    'password' => 'admin',
];

try {
    $response = $client->WSPROCESSEDWRITE($params);

    // Obtener la respuesta cruda del servicio SOAP
    $rawResponse = $client->__getLastResponse();

    return response($rawResponse, 200, ['Content-Type' => 'text/xml']);

} catch (\SoapFault $fault) {
    return response()->json(['error' => 'Error al llamar al servicio SOAP: ' . $fault->getMessage()], 500);
}
}

public function sincronizarLecturas(Request $request)
{
    Log::info('Inicio de sincronizarLecturas');

    $lecturas = $request->input('lecturas'); 

    if (empty($lecturas)) {
        Log::error('No se recibieron lecturas');
        return response()->json(['error' => 'No se recibieron lecturas'], 400);
    }

    Log::info('Lecturas recibidas: ' . count($lecturas));

    $aux = 0;

    foreach ($lecturas as $lectura) {
        try {
            $store_ = DB::connection('db_lectura')->table('controlfactura')->insertGetId([
                "numero_cuenta" => $lectura['NUMERO_CUENTAL'],
                "lectura" => $lectura['LECTURA'],
                "id_usuario" => $lectura['ID_USUARIO']
            ]);

            if ($store_ > 0) {
                $aux++;
            }
        } catch (\Exception $e) {
            Log::error('Error al insertar lectura: ' . $e->getMessage());
        }
    }

    Log::info('Lecturas insertadas: ' . $aux);

    return response()->json(["REST" => $aux]);
}

}
 




