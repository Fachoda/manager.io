<?php

namespace app\frontend;

use app\common\helpers\VoltHelper;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Events\Manager;
use Phalcon\Db\Adapter\Pdo\Mysql as MysqlAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;

class Module
{
    public function config()
    {
        defined('APP_PATH') || define('APP_PATH', realpath('.'));

        return new \Phalcon\Config(array(
            'database' => require(APP_PATH . '/common/config/database.php'),
            'application' => array(
                'controllersDir' => APP_PATH . '/frontend/controllers/',
                'modelsDir'      => APP_PATH . '/frontend/models/',
                'migrationsDir'  => APP_PATH . '/frontend/migrations/',
                'viewsDir'       => APP_PATH . '/frontend/views/',
                'pluginsDir'     => APP_PATH . '/frontend/plugins/',
                'libraryDir'     => APP_PATH . '/frontend/library/',
                'cacheDir'       => APP_PATH . '/frontend/cache/',
                'baseUri'        => '/',
            )
        ));
    }

    /**
     * Register the application namespaces
     */
    public function registerAutoloaders()
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'app\frontend\controllers'  => APP_PATH . '/frontend/controllers/',
            'app\frontend\models'       => APP_PATH . '/frontend/models/',
            'app\frontend\forms'        => APP_PATH . '/frontend/forms/'
        ]);

        $loader->register();
    }

    /**
     * Register services used by the frontend application
     *
     * @param $di
     */
    public function registerServices($di)
    {
        $config = $this->config();

        /**
         * register the dispatcher
         */
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();

            /*$eventManager = new Manager();
            $eventManager->attach('dispatch', new \Acl('frontend'));

            $dispatcher->setEventsManager($eventManager);*/
            $dispatcher->setDefaultNamespace('app\frontend\controllers');

            return $dispatcher;
        });

        /**
         * The URL component is used to generate all kind of urls in the application
         */
        $di->set('url', function () use ($config) {
            $url = new UrlResolver();
            $url->setBaseUri($config->application->baseUri);

            return $url;
        }, true);

        $di->setShared('view', function () use ($config) {
            $view = new View();

            $view->setViewsDir($config->application->viewsDir);

            $view->registerEngines([
                '.volt' => function ($view, $di) use ($config) {
                    $volt = new VoltEngine($view, $di);

                    $volt->setOptions([
                        'compiledPath' => $config->application->cacheDir,
                        'compiledSeparator' => '_'
                    ]);

                    /**
                     * add functions to compiler
                     */
                    VoltHelper::registerViewFunctions($volt, VoltHelper::getUtil(['ng']));

                    return $volt;
                },
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
            ]);

            return $view;
        });

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di->set('db', function () use ($config) {
            return new MysqlAdapter($config->database->toArray());
        });

        /**
         * If the configuration specify the use of metadata adapter use it or use memory otherwise
         */
        $di->set('modelsMetadata', function () {
            return new MetaDataAdapter();
        });

        /**
         * Start the session the first time some component request the session service
         */
        $di->setShared('session', function () {
            $session = new SessionAdapter();
            $session->start();

            return $session;
        });

        /**
         * List of assets that need to be loaded
         */
        $di->setShared('asset_config', function () {
            return require_once(APP_PATH . '/frontend/config/assets.php');
        });
    }
}