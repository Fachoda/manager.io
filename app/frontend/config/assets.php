<?php

/**
 * Keep the assets that need to be loaded and the preferences
 * controller => action => assets
 */

return [
    'fallback' => [
        'js' => [
            'resources' => [
                'js/material-design/dist/scripts/vendor.js',
                'js/material-design/dev/app/scripts/app.module.js',
                'js/material-design/dev/app/scripts/app.config.js',
                'js/material-design/dev/app/scripts/app.route.js',
                'js/material-design/dev/app/scripts/app.run.js',
            ],
            'collection' => 'footer',
            'filter' => true,
            'join' => true,
        ],
        'css' => [
            'resources' => [
                'js/material-design/dist/styles/vendor.css'
            ],
            'collection' => 'header',
            'filter' => true,
            'join' => true,
        ]
    ],
    'index' => [
        'index' => [
            'js' => [
                'resources' => [
                    'js/material-design/dev/app/scripts/index/controllers/IndexCtrl.js',
                ]
            ]
        ],
        'test' => []
    ]
];