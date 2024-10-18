<?php

return [

    'name' => 'Projeto Dois',

    'env' => env('APP_ENV', 'production'),

    'debug' => (bool) env('APP_DEBUG', false),

    'url' => env('APP_URL', 'http://localhost'),

    'timezone' => 'America/Sao_Paulo',

    'locale' => 'pt-BR',

    'fallback_locale' => 'pt-BR',

    'faker_locale' => 'pt_BR',

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    'maintenance' => [
        'driver' => 'file',
        'store' => 'database',
    ],

];
