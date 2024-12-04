<?php

return [
    'name' => 'Carli App',
    'manifest' => [
        'name' => env('APP_NAME', 'Carli App'),
        'short_name' => 'Carli',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#ff729c',
        'display' => 'standalone',
        'orientation' => 'any',
        'status_bar' => 'black',
        'icons' => [
            '72x72' => [
                'path' => '/assets/img/logo-72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/assets/img/logo-96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/assets/img/logo-128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/assets/img/logo-144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/assets/img/logo-152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/assets/img/logo-192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/assets/img/logo-384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/assets/img/logo-512.png',
                'purpose' => 'any maskable'
            ],
            'maskable' => [
                'path' => '/assets/img/maskable_icon.png',
                'purpose' => 'any maskable'
            ]
        ],
        'splash' => [
            '640x1136' => '/assets/img/logo-square.png',
            '750x1334' => '/assets/img/logo-square.png',
            '828x1792' => '/assets/img/logo-square.png',
            '1125x2436' => '/assets/img/logo-square.png',
            '1242x2208' => '/assets/img/logo-square.png',
            '1242x2688' => '/assets/img/logo-square.png',
            '1536x2048' => '/assets/img/logo-square.png',
            '1668x2224' => '/assets/img/logo-square.png',
            '1668x2388' => '/assets/img/logo-square.png',
            '2048x2732' => '/assets/img/logo-square.png',
        ],
        'custom' => []
    ]
];
