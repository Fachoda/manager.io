<?php
// This is global bootstrap for autoloading
defined('PHALCON_DEBUG') or define('PHALCON_DEBUG', true);
defined('APPLICATIONS_PATH') or define('APPLICATIONS_PATH', realpath('../tests'));
defined('APP_PATH') or define('APP_PATH', realpath('../tests'));
defined('PUBLIC_PATH') or define('PUBLIC_PATH', realpath('../../../public'));

require_once(APPLICATIONS_PATH . '/manager/Util.php');
require_once(APPLICATIONS_PATH . '/manager/Application.php');

ini_set('display_errors', true);
error_reporting(E_ALL);

(new Phalcon\Debug())->listen();

$application = new \tests\manager\Application();
$application->registerServices();
$application->registerModule([
    'className'     => 'tests\frontend\Module',
    'path'          => APP_PATH . '/frontend/Module.php'
]);
return $application;