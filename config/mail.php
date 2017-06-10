<?php
return [
   
    'driver' => env('MAIL_DRIVER'),

    'host' => env('MAIL_HOST'),

    'port' => env('MAIL_PORT'),

    'from' => ['address' => 'lookbookpatos@gmail.com', 'name' => 'LookBook'],
    
    'encryption' => 'tls',
    
    'username' => env('MAIL_USER'),

    'password' => env('MAIL_PASS'),

    'sendmail' => '/usr/sbin/sendmail -bs',

    'pretend' =>  false,
];