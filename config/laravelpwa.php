<?php

return [
    'name' => 'Pure Basic',
    'manifest' => [
        'name' => env('Pure Basic', 'Pure Basic'),
        'short_name' => 'Pure Basic',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/logos/72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/logos/96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/logos/128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/logos/144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/logos/152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/logos/192.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/logos/512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/splash/splash-640x1136.png',
            '750x1334' => '/splash/splash-750x1334.png',
            '828x1792' => '/splash/splash-828x1792.png',
            '1125x2436' => '/splash/splash-1125x2436.png',
            '1242x2208' => '/splash/splash-1242x2208.png',
            '1242x2688' => '/splash/splash-1242x2688.png',
            '1536x2048' => '/splash/splash-1536x2048.png',
            '1668x2224' => '/splash/splash-1668x2224.png',
            '1668x2388' => '/splash/splash-1668x2388.png',
            '2048x2732' => '/splash/splash-2048x2732.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "/logos/72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ]
        ],
        'custom' => []
    ]
];
