<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Soap Version
    |--------------------------------------------------------------------------
    |
    | This option defines the default SOAP version.
    |
    | Supported: 1.1, 1.2
    |
    */

    'version' => 1.1,

    /*
    |--------------------------------------------------------------------------
    | Default Client Options
    |--------------------------------------------------------------------------
    |
    | Here you can specify default options that will be passed to the client.
    |
    */

    'default_options' => [
        'exceptions' => true,
        // 'stream_context' => stream_context_create([ // Uncomment if needed
        //     'ssl' => [
        //         'verify_peer' => false,
        //         'verify_peer_name' => false,
        //     ],
        // ]),
    ],

    /*
    |--------------------------------------------------------------------------
    | Soap Wrapper Class Map
    |--------------------------------------------------------------------------
    |
    | If you want to use the PHP SoapServer you can register it here.
    |
    | You can either pass a string that will be directly passed to the
    | SoapServer or you can pass an array containing a type and class
    | parameter. This way it will generate a classmap for you.
    |
    */

    'classmap' => [],

    /*
    |--------------------------------------------------------------------------
    | Defined Soap Services
    |--------------------------------------------------------------------------
    |
    | Here you can define your SOAP services for the application.
    |
    */

    'services' => [
        'portoaguas' => [
            'wsdl' => 'http://bi.portoaguas.gob.ec/SOAP/server.php?wsdl',
            'trace' => true,
            'cache_wsdl' => WSDL_CACHE_NONE,
            // Otras configuraciones como 'login', 'password', etc., si son necesarias.
        ],
        'deportoaguas' => [
            'wsdl' => 'http://192.168.1.218:8080/ServicesPortoaguas/services?WSDL',
            'trace' => true,
            'cache_wsdl' => WSDL_CACHE_NONE,
            // Añade aquí cualquier otra configuración necesaria para este servicio en particular.
        ],
    ],
    

];
