<?php

defined('PHALCON_DEBUG') or define('PHALCON_DEBUG', true);
defined('APP_PATH') or define('APP_PATH', realpath('../app'));
defined('PUBLIC_PATH') or define('PUBLIC_PATH', realpath('../public'));

require_once(APP_PATH . '/bootstrap/Router.php');
require_once(APP_PATH . '/bootstrap/Application.php');

if (defined('PHALCON_DEBUG') && PHALCON_DEBUG === true) {
    ini_set('display_errors', true);
    error_reporting(E_ALL);

    (new Phalcon\Debug())->listen();

    $application = new \app\bootstrap\Application();
    $application->run();
} else {
    try {
        $application = new \app\bootstrap\Application();
        $application->run();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}