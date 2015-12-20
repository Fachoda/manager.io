<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 14.12.2015
 * Time: 21:35
 */

ini_set('display_errors', true);
error_reporting(E_ALL);

defined('APP_PATH') or define('APP_PATH', realpath('../../app'));
defined('PUBLIC_PATH') or define('PUBLIC_PATH', realpath('../../public'));

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';
require_once(APP_PATH . '/bootstrap/Micro.php');

$app = new \app\bootstrap\Micro();
$response = false;

try {
    $response = $app->run();
} catch (\Exception $e) {
    echo "An error has occured: " . $e->getMessage();
}

if ($response !== false && $response !== null) {
    $response->sendHeaders();
    $response->send();
}