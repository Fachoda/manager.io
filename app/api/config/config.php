<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => 'root123',
        'dbname'      => 'manager',
        'charset'     => 'utf8',
    ),
    'application' => array(
        'controllersDir' => APP_PATH . '/frontend/controllers/',
        'modelsDir'      => APP_PATH . '/frontend/models/',
        'migrationsDir'  => APP_PATH . '/frontend/migrations/',
        'viewsDir'       => APP_PATH . '/frontend/views/',
        'pluginsDir'     => APP_PATH . '/frontend/plugins/',
        'libraryDir'     => APP_PATH . '/frontend/library/',
        'cacheDir'       => APP_PATH . '/frontend/cache/',
        'baseUri'        => '/manager.io/',
    )
));
