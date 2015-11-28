<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 18:35
 */

namespace app\bootstrap;

use Phalcon\Di\FactoryDefault;
use Phalcon\Loader as PhLoader;
use Phalcon\Mvc\Application as PhApplication;
use Phalcon\Mvc\Router;

class Application extends PhApplication
{
    protected $modules = [
        'hrm' => [
            'className' => 'app\hrm\Module',
            'path' => APP_PATH . '/hrm/Module.php'
        ]
    ];

    /**
     * registerServices
     * registerModules
     * show the output
     */
    public function run()
    {
        $this->registerServices();

        $this->registerModules($this->modules);

        echo $this->handle()->getContent();
    }

    /**
     * create a new dependency injector and register the namespaces
     */
    protected function registerServices()
    {
        $this->setDI(new FactoryDefault());

        $this->initNamespaces();
        $this->initRouter();
    }

    /**
     * load the namespaces so that they are visible in the project
     */
    protected function initNamespaces()
    {
        $loader = new PhLoader();

        $namespaces = [];
        $map = require_once(__DIR__ . '/autoload_namespaces.php');

        foreach ($map as $k => $values) {
            $k = trim($k, '\\');
            if (!isset($namespaces[$k])) {
                $dir = '/' . str_replace('\\', '/', $k) . '/';
                $namespaces[$k] = implode($dir . ';', $values) . $dir;
            }
        }

        $loader->registerNamespaces($namespaces);
        $loader->register();
    }

    protected function initRouter()
    {
        $this->getDI()->set('router', function () {
            $router = new Router();

            $router->setDefaultModule('hrm');

            return $router;
        });
    }
}
