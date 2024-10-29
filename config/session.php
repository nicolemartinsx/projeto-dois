<?php

use Illuminate\Support\Str;

return [

    'driver' => 'database',

    'lifetime' => 60,

    'expire_on_close' => false,

    'encrypt' => true,

    'table' => 'sessions',

    'lottery' => [2, 100],

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_') . '_session'
    ),

    'path' => '/',

    'secure' => env('SESSION_SECURE_COOKIE', true),

    'http_only' => true,

    'same_site' => "lax",

    'partitioned' => false,

];
