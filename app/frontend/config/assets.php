<?php

/**
 * Keep the assets that need to be loaded and the preferences
 * controller => action => assets
 */

return [
    'fallback' => [
        'js' => [
            'resources' => [
                '/js/material-design/dist/scripts/vendor.js',
                '/js/material-design/dev/app/scripts/app.module.js',
                '/js/material-design/dev/app/scripts/app.config.js',
                '/js/material-design/dev/app/scripts/app.route.js',
                '/js/material-design/dev/app/scripts/app.run.js',
            ],
            'collection' => 'footer',
            'filter' => true,
            'join' => true,
        ],
        'css' => [
            'resources' => [
//                'js/material-design/dist/styles/vendor.css'
                'css/material/font-awesome.min.css',
                'css/material/bootstrap.min.css',
                'css/material/bootstrap-theme.min.css',
                'css/material/angular-material.min.css',
                'css/material/main.css',
            ],
            'collection' => 'header',
            'filter' => false,
            'join' => false,
        ]
    ],
    'index' => [
        'index' => [
            'js' => [
                'resources' => [
                    '/js/material-design/dev/app/scripts/index/controllers/IndexCtrl.js',
                ]
            ]
        ],
        'test' => []
    ],
    'session' => [
        'login' => [
            'css' => [
                'resources' => [
                    'css/material/session.css'
                ]
            ]
        ]
    ]
];