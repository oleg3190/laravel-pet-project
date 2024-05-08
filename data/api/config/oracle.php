<?php

return [
    'oracle' => [
        'driver'         => 'oracle',
        //'tns'            => env('DB_TNS', ''),
        'host'           => env('DB_HOST', 'oracle'),
        'port'           => env('DB_PORT', '1521'),
        'database'       => env('DB_DATABASE', 'PDB1'),
        'service_name'   => env('DB_SERVICENAME', 'XEPDB1'),
        'username'       => env('DB_USERNAME', 'demo'),
        'password'       => env('DB_PASSWORD', 'demo'),
        'charset'        => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '21c'),
        'load_balance'   => env('DB_LOAD_BALANCE', 'yes'),
        'dynamic'        => [],
    ],
];
