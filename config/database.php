<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PDO Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, database results will be returned as instances of the PHP
    | stdClass object; however, you may desire to retrieve records in an
    | array format for simplicity. Here you can tweak the fetch style.
    |
    */

    'fetch' => PDO::FETCH_OBJ,

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
        'mysql2' => [
            'driver' => 'mysql',
            'host' => env('DB_HOSTP', '127.0.0.1'),
            'port' => env('DB_PORTP', '3306'),
            'database' => env('DB_DATABASEP', 'forge'),
            'username' => env('DB_USERNAMEP', 'forge'),
            'password' => env('DB_PASSWORDP', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],
        'mariadb' => [
            'driver' => 'mysql', 
            'host' => env('MARIADB_HOST', '127.0.0.1'),
            'port' => env('MARIADB_PORT', '3306'),
            'database' => env('MARIADB_DATABASE', 'forge'),
            'username' => env('MARIADB_USERNAME', 'forge'),
            'password' => env('MARIADB_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ], 
        'sql_cumpleanos' => [
            'driver' => 'sqlsrv',
            'host' => env('DBP_HOST', 'localhost'),
            'port' => env('DBP_PORT', '1433'),
            'database' => env('DBP_DATABASE', 'forge'),
            'username' => env('DBP_USERNAME', 'forge'),
            'password' => env('DBP_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],
        'mysql_guardianes' => [
            'driver' => 'mysql',
            'host' => env('APP_G_HOST', '127.0.0.1'),
            'port' => env('APP_G_PORT', '3306'),
            'database' => env('APP_G_DATABASE', 'forge'),
            'username' => env('APP_G_USERNAME', 'forge'),
            'password' => env('APP_G_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'mysql_g_ficha' => [
            'driver' => 'mysql',
            'host' => env('APP_G_FICHA_HOST', '127.0.0.1'),
            'port' => env('APP_G_FICHA_PORT', '3306'),
            'database' => env('APP_G_FICHA_DATABASE', 'forge'),
            'username' => env('APP_G_FICHA_USERNAME', 'forge'),
            'password' => env('APP_G_FICHA_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'mysql_censo' => [
            'driver' => 'mysql',
            'host' => env('DBCENSO_HOST', '127.0.0.1'),
            'port' => env('DBCENSO_PORT', '3306'),
            'database' => env('DBCENSO_DATABASE', 'forge'),
            'username' => env('DBCENSO_USERNAME', 'forge'),
            'password' => env('DBCENSO_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'mysql_file_d' => [
            'driver' => 'mysql',
            'host' => env('DBFILE_D_HOST', '127.0.0.1'),
            'port' => env('DBFILE_D_PORT', '3306'),
            'database' => env('DBFILE_D_DATABASE', 'forge'),
            'username' => env('DBFILE_D_USERNAME', 'forge'),
            'password' => env('DBFILE_D_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'mysql_file_dd' => [
            'driver' => 'mysql',
            'host' => env('DBFILE_DD_HOST', '127.0.0.1'),
            'port' => env('DBFILE_DD_PORT', '3306'),
            'database' => env('DBFILE_DD_DATABASE', 'forge'),
            'username' => env('DBFILE_DD_USERNAME', 'forge'),
            'password' => env('DBFILE_DD_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'mysql_censo2' => [
            'driver' => 'mysql',
            'host' => env('DB_CENSO_HOST', '127.0.0.1'),
            'port' => env('DB_CENSO_PORT', '3306'),
            'database' => env('DB_CENSO_DATABASE', 'forge'),
            'username' => env('DB_CENSO_USERNAME', 'forge'),
            'password' => env('DB_CENSO_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'mysql_eva' => [
            'driver' => 'mysql',
            'host' => env('DB_EVA_HOST', '127.0.0.1'),
            'port' => env('DB_EVA_PORT', '3306'),
            'database' => env('DB_EVA_DATABASE', 'forge'),
            'username' => env('DB_EVA_USERNAME', 'forge'),
            'password' => env('DB_EVA_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'mysql_clave' => [
            'driver' => 'mysql',
            'host' => env('DB_CLAVE_HOST', '127.0.0.1'),
            'port' => env('DB_CLAVE_PORT', '3306'),
            'database' => env('DB_CLAVE_DATABASE', 'forge'),
            'username' => env('DB_CLAVE_USERNAME', 'forge'),
            'password' => env('DB_CLAVE_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'mysql_gps' => [
            'driver' => 'mysql',
            'host' => env('GPS_HOST', '127.0.0.1'),
            'port' => env('GPS_PORT', '3306'),
            'database' => env('GPS_DATABASE', 'forge'),
            'username' => env('GPS_USERNAME', 'forge'),
            'password' => env('GPS_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'mysql_desarrollo' => [
            'driver' => 'mysql',
            'host' => env('DESA_HOST', '127.0.0.1'),
            'port' => env('DESA_PORT', '3306'),
            'database' => env('DESA_DATABASE', 'forge'),
            'username' => env('DESA_USERNAME', 'forge'),
            'password' => env('DESA_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'mysql_masoluc' => [
            'driver' => 'mysql',
            'host' => env('GEST_HOST', '127.0.0.1'),
            'port' => env('GEST_PORT', '3306'),
            'database' => env('GEST_DATABASE', 'forge'),
            'username' => env('GEST_USERNAME', 'forge'),
            'password' => env('GEST_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'mysql_app' => [
            'driver' => 'mysql',
            'host' => env('APP_HOST', '127.0.0.1'),
            'port' => env('APP_PORT', '3306'),
            'database' => env('APP_DATABASE', 'forge'),
            'username' => env('APP_USERNAME', 'forge'),
            'password' => env('APP_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'mysql_estacion' => [
            'driver' => 'mysql',
            'host' => env('ESTA_HOST', '127.0.0.1'),
            'port' => env('ESTA_PORT', '3306'),
            'database' => env('ESTA_DATABASE', 'forge'),
            'username' => env('ESTA_USERNAME', 'forge'),
            'password' => env('ESTA_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'mysql_aflow' => [
            'driver' => 'mysql',
            'host' => env('AFLOW_HOST', '127.0.0.1'),
            'port' => env('AFLOW_PORT', '3306'),
            'database' => env('AFLOW_DATABASE', 'forge'),
            'username' => env('AFLOW_USERNAME', 'forge'),
            'password' => env('AFLOW_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish2_ci',
            'prefix' => '',
        ],

        'mysql_aflow1' => [
            'driver' => 'mysql',
            'host' => env('AFLOW1_HOST', '127.0.0.1'),
            'port' => env('AFLOW1_PORT', '3306'),
            'database' => env('AFLOW1_DATABASE', 'forge'),
            'username' => env('AFLOW1_USERNAME', 'forge'),
            'password' => env('AFLOW1_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish2_ci',
            'prefix' => '',
        ],

        'mysql_afile' => [
            'driver' => 'mysql',
            'host' => env('AFILE_HOST', '127.0.0.1'),
            'port' => env('AFILE_PORT', '3306'),
            'database' => env('AFILE_DATABASE', 'forge'),
            'username' => env('AFILE_USERNAME', 'forge'),
            'password' => env('AFILE_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
        ],

        'mysql_ficha' => [
            'driver' => 'mysql',
            'host' => env('FICHA_HOST', '127.0.0.1'),
            'port' => env('FICHA_PORT', '3306'),
            'database' => env('FICHA_DATABASE', 'forge'),
            'username' => env('FICHA_USERNAME', 'forge'),
            'password' => env('FICHA_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
        ],

        'mysql_afile_data' => [
            'driver' => 'mysql',
            'host' => env('AFILE_DATA_HOST', '127.0.0.1'),
            'port' => env('AFILE_DATA_PORT', '3306'),
            'database' => env('AFILE_DATA_DATABASE', 'forge'),
            'username' => env('AFILE_DATA_USERNAME', 'forge'),
            'password' => env('AFILE_DATA_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
        ],

        'mysql_volley' => [
            'driver' => 'mysql',
            'host' => env('VOLLEY_HOST', '127.0.0.1'),
            'port' => env('VOLLEY_PORT', '3306'),
            'database' => env('VOLLEY_DATABASE', 'forge'),
            'username' => env('VOLLEY_USERNAME', 'forge'),
            'password' => env('VOLLEY_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],
        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('SQL_HOST', 'localhost'),
            'database' => env('SQL_DATABASE', 'forge'),
            'username' => env('SQL_USERNAME', 'forge'),
            'password' => env('SQL_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],
        'sqlsrv2' => [
            'driver' => 'sqlsrv',
            'host' => env('SQL2_HOST', 'localhost'),
            'database' => env('SQL2_DATABASE', 'forge'),
            'username' => env('SQL2_USERNAME', 'forge'),
            'password' => env('SQL2_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],
        'sqlsrv_3' => [
            'driver' => 'sqlsrv',
            'host' => env('SQL3_HOST', 'localhost'),
            'database' => env('SQL3_DATABASE', 'forge'),
            'username' => env('SQL3_USERNAME', 'forge'),
            'password' => env('SQL3_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],

        'sqlsrv_4' => [
            'driver' => 'sqlsrv',
            'host' => env('SQL4_HOST', 'localhost'),
            'database' => env('SQL4_DATABASE', 'forge'),
            'username' => env('SQL4_USERNAME', 'forge'),
            'password' => env('SQL4_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],
        'sqlsrv_5' => [
            'driver' => 'sqlsrv',
            'host' => env('SQL5_HOST', 'localhost'),
            'database' => env('SQL5_DATABASE', 'forge'),
            'username' => env('SQL5_USERNAME', 'forge'),
            'password' => env('SQL5_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],
        'sqlsrv_6' => [
            'driver' => 'sqlsrv',
            'host' => env('SQL6_HOST', 'localhost'),
			'port' => env('SQL6_PORT', '1433'),
            'database' => env('SQL6_DATABASE', 'forge'),
            'username' => env('SQL6_USERNAME', 'forge'),
            'password' => env('SQL6_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
			'options'   => [
			'ConnectTimeout' => 30, // Aumenta este valor según sea necesario
							],
        ],
        'sqlsrv_7' => [
            'driver' => 'sqlsrv',
            'host' => env('SQL7_HOST', 'localhost'),
            'database' => env('SQL7_DATABASE', 'forge'),
            'username' => env('SQL7_USERNAME', 'forge'),
            'password' => env('SQL7_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],
        'sqlsrv_8' => [
            'driver' => 'sqlsrv',
            'host' => env('SQL8_HOST', 'localhost'),
            'database' => env('SQL8_DATABASE', 'forge'),
            'username' => env('SQL8_USERNAME', 'forge'),
            'password' => env('SQL8_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],
        'sybase' => [
            'driver'   => 'sqlsrv',
            'host'     => env('SYBASE_HOST', 'sybase.myserver.br:5000'),
            'database' => env('SYBASE_DATABASE', 'mydatabase'),
            'username' => env('SYBASE_USERNAME', 'forge'),
            'password' => env('SYBASE_PASSWORD', 'secret'),
            'charset'  => 'utf8',
            'prefix'   => '',
        ],
        'mysql_monitoreo' => [
            'driver' => 'mysql',
            'host' => env('M_HOST', '127.0.0.1'),
            'port' => env('M_PORT', '3306'),
            'database' => env('M_DATABASE', 'forge'),
            'username' => env('M_USERNAME', 'forge'),
            'password' => env('M_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_spanish_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'cluster' => false,

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
