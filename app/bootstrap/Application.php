<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 18:35
 */

namespace app\bootstrap;

use Phalcon\Di\FactoryDefault as PhFactoryDefault;
use Phalcon\Loader as PhLoader;
use Phalcon\Mvc\Application as PhApplication;

class Application extends PhApplication
{
    protected $modules = [
        'hrm' => [
            'className' => 'app\hrm\Module',
            'path' => APP_PATH . '/hrm/Module.php'
        ],
        'pm' => [
            'className' => 'app\pm\Module',
            'path' => APP_PATH . '/pm/Module.php'
        ],
        'core' => [
            'className' => 'app\core\Module',
            'path' => APP_PATH . '/core/Module.php'
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
        $this->setDI(new PhFactoryDefault());

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

    /**
     * initialize the router
     */
    protected function initRouter()
    {
        $this->getDI()->set('router', function () {
            $router = new Router();

            $router->setDefaults([
                'module' => 'pm',
                'controller' => 'index',
                'action' => 'index'
            ]);

            return $router;
        });
    }
}
