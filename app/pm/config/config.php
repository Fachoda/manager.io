<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 19:29
 */

return [
    'database' => [
        'adapter'       => 'Mysql',
        'host'          => '127.0.0.1',
        'username'      => 'root',
        'password'      => 'ovrjt7nc',
        'dbname'        => 'manager'
    ],
    'app' => [
        'debug'     => true,
        'timezone'  => 'US/Eastern',
        'baseUri'   => 'http://manager.io/',
        'path'      => [
            'controllersDir'    => APP_PATH . '/hrm/controllers/',
            'modelsDir'         => APP_PATH . '/hrm/models',
            'viewsDir'          => APP_PATH . '/hrm/views',
        ],
        'cache'     => [
            'cacheDir'  => APP_PATH . '/hrm/runtime/cache',
            'lifetime'  => 86400
        ],
        'logger'    => [
            'adapter'   => 'File',
            'file'      => APP_PATH . '/hrm/runtime/logs/messages.log',
            'format'    => '[%date%][%type%] %message%',
        ],
        'volt'      => [
            'path'      => APP_PATH . '/hrm/runtime/volt/',
            'separator' => '_'
        ],
        'runtime'   => [
            APP_PATH . '/hrm/runtime/cache',
            APP_PATH . '/hrm/runtime/logs',
            APP_PATH . '/hrm/runtime/volt'
        ]
    ]
];

