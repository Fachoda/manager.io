<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 19:29
 */

$basePath = APP_PATH . '/core/';

return [
    'mongo' => [
        'adapter'       => 'Mongo',
        'host'          => '127.0.0.1',
        'port'          => '27017',
        'username'      => 'root',
        'password'      => 'root123',
        'dbname'        => 'time_track'
    ],
    'database' => [
        'adapter'       => 'Mysql',
        'host'          => '127.0.0.1',
        'username'      => 'root',
        'password'      => 'ovrjt7nc',
        'dbname'        => '[database_name]'
    ],
    'app' => [
        'debug'     => true,
        'timezone'  => 'US/Eastern',
        'baseUri'   => 'http://manager.io/',
        'path'      => [
            'controllersDir'    => $basePath . 'controllers',
            'modelsDir'         => $basePath . 'models',
            'viewsDir'          => $basePath . 'views',
        ],
        'cache'     => [
            'cacheDir'  => $basePath . 'runtime/cache',
            'lifetime'  => 86400
        ],
        'logger'    => [
            'adapter'   => 'File',
            'file'      => $basePath . 'runtime/logs/messages.log',
            'format'    => '[%date%][%type%] %message%',
        ],
        'volt'      => [
            'path'      => $basePath . 'runtime/volt/',
            'separator' => '_'
        ],
        'runtime'   => [
            $basePath . 'runtime/cache',
            $basePath . 'runtime/logs',
            $basePath . 'runtime/volt'
        ]
    ]
];

