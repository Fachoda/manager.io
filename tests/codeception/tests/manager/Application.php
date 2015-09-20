<?php

/**
 * manager/Application.php
 *
 * Application bootstrap class file
 */

namespace tests\manager;

use tests_manager\router\FrontendRoutes;
use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
     */
    public function registerServices()
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

    public function registerModule($module)
    {
        $mod =  new $module['className']();
        $mod->registerServices($this->getDI());
    }
}