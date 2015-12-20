<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 19:29
 */

$basePath = APP_PATH . '/api/';

return [
    'mongo' => [
        'adapter'       => 'Mongo',
        'host'          => '127.0.0.1',
        'port'          => '27017',
        'username'      => 'root',
        'password'      => 'root123',
        'dbname'        => 'time_track'
    ],
    'app' => [
        'debug'     => true,
        'timezone'  => 'US/Eastern',
        'baseUri'   => 'http://manager.io/api',
        'path'      => [
            'controllersDir'    => $basePath . 'controllers',
            'modelsDir'         => $basePath . 'models',
            'viewsDir'          => $basePath . 'views',
        ],
        'logger'    => [
            'adapter'   => 'File',
            'file'      => $basePath . 'runtime/logs/messages.log',
            'format'    => '[%date%][%type%] %message%',
        ],
        'runtime'   => [
            $basePath . 'runtime/cache',
            $basePath . 'runtime/logs',
            $basePath . 'runtime/volt'
        ]
    ]
];

