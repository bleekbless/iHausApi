<?php
return[
    'driver' => env('SESSION_DRIVER', 'cookie'),

    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'store' => null,
    'lottery' => [2, 100],

    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => env('SESSION_DOMAIN', null),
    'secure' => false,
    'http_only' => true,
];