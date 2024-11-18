<?php

return [

    'default' => 'local',

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
        ],

        'private' => [
            'driver' => 'local',
            'root' => storage_path('app/private'), // Specify the directory for private files
            'url' => env('APP_URL') . '/storage/private', // Optional: URL for accessing files
            'visibility' => 'private', // Set visibility to private
            'throw' => false, // Optional: throw exceptions on write failures
        ],
        
    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
