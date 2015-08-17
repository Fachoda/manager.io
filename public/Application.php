<?php

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

        /**
         * Register the common libraries
         */
        $loader->registerDirs([
            __DIR__ . '/../common/libraries/'
        ])->register();

        /**
         * Register a router
         */
        $di->set('router', function () {
            $router = new Router();

            $router->setDefaultModule('frontend');

            $router->add('/:controller/:action', [
                'module' => 'frontend',
                'controller' => 1,
                'action' => 2
            ]);

            $router->add('/admin', [
                'module' => 'backend',
                'controller' => 'index',
                'action' => 'index'
            ]);

            $router->add('/admin/:controller/:action', [
                'module' => 'backend',
                'controller' => 1,
                'action' => 2
            ]);

            $router->add('/api/:controller/:action', [
                'module' => 'api',
                'controller' => 1,
                'action' => 2
            ]);

            $router->add('/console/:controller/:action', [
                'module' => 'console',
                'controller' => 1,
                'action' => 2
            ]);

            return $router;
        });

        $this->setDI($di);
    }

    public function run()
    {
        $this->registerServices();

        $this->registerModules([
            'frontend' => [
                'className' => 'app\frontend\Module',
                'path' => APP_PATH . '/frontend/Module.php'
            ],
            'backend' => [
                'className' => 'app\backend\Module',
                'path' => APP_PATH . '/backend/Module.php'
            ]
        ]);

        echo $this->handle()->getContent();
    }
}