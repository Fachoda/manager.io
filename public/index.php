<?php
defined('PHALCON_DEBUG') or define('PHALCON_DEBUG', true);
defined('LIBRARY_PATH') or define('LIBRARY_PATH', realpath('../app/library'));
defined('APP_PATH') or define('APP_PATH', realpath('../app'));
defined('PUBLIC_PATH') or define('PUBLIC_PATH', realpath('../public'));

require_once(LIBRARY_PATH . '/manager/Util.php');
require_once(LIBRARY_PATH . '/manager/Application.php');

if (defined('PHALCON_DEBUG') && PHALCON_DEBUG === true) {
    ini_set('display_errors', true);
    error_reporting(E_ALL);

    (new Phalcon\Debug())->listen();

    $application = new \manager\Application();
    $application->run();
} else {
    try {
        /**
         * Handle requests
         */
        $application = new \manager\Application();
        $application->run();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}