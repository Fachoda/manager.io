<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
define('APP_PATH', realpath('..'));

require_once(__DIR__ . '/Application.php');

$application = new Application();
$application->run();

//try {
//
//    /**
//     * Read the configuration
//     */
//    $config = include APP_PATH . "/frontend/config/config.php";
//
//    /**
//     * Read auto-loader
//     */
//    include APP_PATH . "/frontend/config/loader.php";
//
//    /**
//     * Read services
//     */
//    include APP_PATH . "/frontend/config/services.php";
//
//    /**
//     * Handle the request
//     */
//    $application = new \Phalcon\Mvc\Application($di);
//
//    echo $application->handle()->getContent();
//
//} catch (\Exception $e) {
//    echo $e->getMessage();
//}
