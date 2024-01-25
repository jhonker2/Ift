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


class LectofacturaApp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data; // Definir la propiedad data

    public function __construct(array $data) // Asegurar que el constructor acepte un array
    {
        $this->data = $data; // Asignar el valor de data
    }

    public function handle()
    {
        $r = (object) $this->data;
    
        try {
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
    
          
    
        } catch (\Exception $e) {
            Log::error('Error en sincronizarLecturas', ['error' => $e->getMessage(), 'request' => $r->all()]);
        }
    }
    
    
}
