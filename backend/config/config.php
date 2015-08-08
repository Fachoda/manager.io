<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => require(APP_PATH . '/common/config/database.php'),
    'application' => array(
        'controllersDir' => APP_PATH . '/backend/controllers/',
        'modelsDir'      => APP_PATH . '/backend/models/',
        'migrationsDir'  => APP_PATH . '/backend/migrations/',
        'viewsDir'       => APP_PATH . '/backend/views/',
        'pluginsDir'     => APP_PATH . '/backend/plugins/',
        'libraryDir'     => APP_PATH . '/backend/library/',
        'cacheDir'       => APP_PATH . '/backend/cache/',
        'baseUri'        => '/manager.io/',
    )
));
