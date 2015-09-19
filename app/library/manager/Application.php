<?php

/**
 * manager/Application.php
 *
 * Application bootstrap class file
 */

namespace manager;

use manager\router\FrontendRoutes;
use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
     */
    protected function registerServices()
    {
        $di = new FactoryDefault();
        $loader = new Loader();

        $namespaces = [];
        $map = require_once(__DIR__. '/../autoload_namespaces.php');

        foreach ($map as $k => $values) {
            $k = trim($k, '\\');
            if (!isset($namespaces[$k])) {
                $dir = '/' . str_replace('\\', '/', $k) . '/';
                $namespaces[$k] = implode($dir . ';', $values) . $dir;
            }
        }

        $loader->registerNamespaces($namespaces);

        $loader->register();

        /**
         * Register a router
         */
        $di->set('router', function () {
            $router = new Router();

            $router->setDefaultModule('frontend');

            //set frontend routes
            $router->mount(new FrontendRoutes());
//
            return $router;
        });

        $this->setDI($di);
    }

    public function run()
    {
        $this->registerServices();

        $this->registerModules([
            'frontend' => [
                'className'     => 'app\frontend\Module',
                'path'          => APP_PATH . '/frontend/Module.php'
            ],
            'backend' => [
                'className'     => 'app\backend\Module',
                'path'          => APP_PATH . '/backend/Module.php'
            ]
        ]);

        echo $this->handle()->getContent();
    }
}