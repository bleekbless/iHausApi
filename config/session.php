<?php
return[
    'driver' => env('SESSION_DRIVER'),

    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'store' => null,
    'lottery' => [2, 100],
    'table' => 'sessions',
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => env('SESSION_DOMAIN', null),
    'secure' => false,
    'http_only' => true,
];