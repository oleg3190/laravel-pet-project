<?php

return [
    'production' => [
        'schema' => 'http',
        'domain' => '123.456.78.90',
        'port'   => '9201',
        'index'  => 'laravel-production-' . date('Y.m.d'),
        'type'   => '_doc'
    ],
    'local'      => [
        'schema' => 'http',
        'domain' => '123.456.78.90',
        'port'   => '9201',
        'index'  => 'laravel-local-' . date('Y.m.d'),
        'type'   => '_doc'
    ]
];