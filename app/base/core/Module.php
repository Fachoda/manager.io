<?php

namespace app\base\core;

use app\base\exceptions\NotImplementedException;
use app\base\helpers\FileHelper;
use manager\Router;
use Phalcon\Config as PhConfig;
use Phalcon\DI\FactoryDefault as PhFactoryDefault;
use Phalcon\Di\FactoryDefault;
use Phalcon\Events\Event as PhEvent;
use Phalcon\Events\Manager as PhEventsManager;
use Phalcon\Flash\Session as PhFlash;
use Phalcon\Loader as PhLoader;
use Phalcon\Logger as PhLogger;
use Phalcon\Session\Adapter\Files as PhSession;
use Phalcon\Cache\Frontend\Data as PhCacheFront;
use Phalcon\Cache\Backend\File as PhCacheBack;
use Phalcon\Logger\Adapter\File as PhLoggerFile;
use Phalcon\Logger\Formatter\Line as PhLoggerFormatter;
use Phalcon\Db\Adapter\Pdo\Mysql as PhDbAdapter;
use Phalcon\Mvc\Application as PhApplication;
use Phalcon\Mvc\Model\MetaData\Memory as PhMetaDataMemory;
use Phalcon\Mvc\Model\MetaData\Files as PhMetaDataFiles;
use Phalcon\Mvc\Url as PhUrl;
use Phalcon\Mvc\View as PhView;

abstract class Module
{
    protected $loaders = [
        'config',
        'debug',
        'logger',
        'environment',
        'dispatcher',
        'database',
        'session',
        'cache',
        'modelsMetaData',
        'view',
        'timezone',
        'flash',
        'url',
    ];

    protected $defaultNamespace;

    /**
     * @var $di PhFactoryDefault
     */
    private $di;

    /**
     * register module specific namespaces
     */
    public function registerAutoloaders()
    {

    }
    
    /**
     * register the module
     *
     * @param FactoryDefault $di
     */
    public function registerServices(PhFactoryDefault $di)
    {
        $this->di = $di;
        $this->initLoaders();
    }

    /**
     * call each service in the list
     */
    protected function initLoaders()
    {
        if (is_array($this->loaders) && !empty($this->loaders)) {
            foreach ($this->loaders as $service) {
                $method = $this->serviceName($service);
                call_user_func([$this, $method]);
            }
        }
    }

    /**
     * initialize the config
     *
     * @throws NotImplementedException
     */
    protected function initConfig()
    {
        $configFile = $this->getConfigFile();
        $config = new PhConfig($configFile);

        $this->di->set('config', $config);
    }

    /**
     * return the contents of the config file, must be implemented
     *
     * @return null|string
     * @throws NotImplementedException
     */
    protected function getConfigFile()
    {
        throw new NotImplementedException('please provide a valid configuration file');
    }

    /**
     * set error handlers and debug options
     */
    protected function initEnvironment()
    {
        $config = $this->di->get('config');

        $directories = $config->app->runtime;
        foreach ($directories as $directory) {
            FileHelper::createDirectory($directory);
        }

        $debug = (isset($config->app->debug)) ? (bool) $config->app->debug : false;

        if ($debug) {
            ini_set('display_errors', true);
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', false);
        }

        set_error_handler(['\app\base\core\Error', 'normal']);
        set_exception_handler(['\app\base\core\Error', 'exception']);
        register_shutdown_function(['\app\base\core\Error', 'shutdown']);
    }

    /**
     * set the router
     *
     * @throws NotImplementedException
     */
    protected function initRouter()
    {
        if (empty($this->defaultModule)) {
            throw new \InvalidArgumentException('no default module provided');
        }

        $this->di->set('router', $this->getRouter());
    }

    /**
     * get the router, must be implemented
     *
     * @return null
     * @throws NotImplementedException
     */
    protected function getRouter()
    {
        throw new NotImplementedException('the router method needs to be implemented');
    }

    /**
     * set the dispatcher
     */
    protected function initDispatcher()
    {
        $this->di->set('dispatcher', $this->getDispatcher());
    }

    /**
     * register the view component
     */
    protected function initView()
    {
        $config = $this->di->get('config');

        $this->di->setShared('view', function () use ($config) {
            $view = new PhView();

            $view->setViewsDir($config->app->path->viewsDir);

            $view->registerEngines([
                '.volt' => function ($view, $di) use ($config) {
                    $volt = new PhView\Engine\Volt($view, $di);

                    $volt->setOptions([
                        'compiledPath' => $config->app->volt->path,
                        'compiledSeparator' => $config->app->volt->separator
                    ]);

                    return $volt;
                },
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
            ]);

            return $view;
        });
    }

    /**
     * get the dispatcher, must be implemented
     *
     * @return null
     * @throws NotImplementedException
     */
    protected function getDispatcher()
    {
        throw new NotImplementedException('the dispatcher method needs to be implemented');
    }

    /**
     * initialize the timezone
     */
    protected function initTimezone()
    {
        $config = $this->di->get('config');

        $timezone = (isset($config->app->timezeone)) ? $config->app->timezone : 'US/Eastern';

        date_default_timezone_set($timezone);

        $this->di->set('timezone_default', $timezone);
    }

    /**
     * initialze the flash manager
     */
    protected function initFlash()
    {
        $this->di->set('flash', function () {
            $params = [
                'error'     => 'alert alert-error',
                'success'   => 'alert alert-success',
                'info'      => 'alert alert-info'
            ];

            return new PhFlash($params);
        });
    }

    /**
     * initialize the base url for the application
     */
    protected function initUrl()
    {
        $config = $this->di->get('config');

        $this->di->set('url', function () use ($config) {
            $url = new PhUrl();
            $url->setBaseUri($config->app->baseUri);

            return $url;
        });
    }

    /**
     * initialize the logging service
     */
    protected function initLogger()
    {
        $config = $this->di->get('config');

        $this->di->set('logger', function () use ($config) {

            $logger = new PhLoggerFile($config->app->logger->file);
            $formatter = new PhLoggerFormatter($config->app->logger->format);

            $logger->setFormatter($formatter);

            return $logger;
        });
    }

    /**
     * set the database connection under db
     */
    protected function initDatabase()
    {
        $config = $this->di->get('config');
        $logger = $this->di->get('logger');

        $debug = (isset($config->app->debug)) ? (bool) $config->app->debug : false;

        $this->di->set('db', function () use ($config, $debug, $logger) {

            $params = [
                'host'      => $config->database->host,
                'username'  => $config->database->username,
                'password'  => $config->database->password,
                'dbname'    => $config->database->name
            ];

            $connection = new PhDbAdapter($params);

            if ($debug) {
                $eventsManager = new PhEventsManager();
                $eventsManager->attach('db', function (PhEvent $event, PhDbAdapter $connection) use ($logger) {
                    if ($event->getType() == 'beforeQuery') {
                        $logger->log(
                            $connection->getSQLStatement(),
                            PhLogger::INFO
                        );
                    }
                });

                $connection->setEventsManager($eventsManager);
            }

            return $connection;
        });
    }

    /**
     * choose where to store the metadata of the models in files or in memory
     */
    protected function initModelsMetaData()
    {
        $config = $this->di->get('config');

        $this->di->set('modelsMetadata', function () use ($config) {
            if (isset($config->app->metadata)) {
                if ($config->app->metadata->adapter === 'Files') {
                    return new PhMetaDataFiles([
                        'metaDataDir' => $config->app->metadata->path
                    ]);
                }
            }

            return new PhMetaDataMemory();
        });
    }

    /**
     * initialize the session, start one if necessary
     */
    protected function initSession()
    {
        $this->di->set('session', function () {
            $session = new PhSession();

            if (!$session->isStarted()) {
                $session->start();
            }

            return $session;
        });
    }

    /**
     * initialize the cache
     */
    protected function initCache()
    {
        $config = $this->di->get('config');

        $this->di->set('cache', function () use ($config) {
            $lifetime           = $config->app->cache->lifetime;
            $cacheDir           = $config->app->cache->cacheDir;
            $frontendOptions    = ['lifetime' => $lifetime];
            $backendOptions     = ['cacheDir' => APP_PATH . $cacheDir];

            $frontCache = new PhCacheFront($frontendOptions);
            $cache   = new PhCacheBack($frontCache, $backendOptions);

            return $cache;
        });
    }

    /**
     * initialize the debugging functions
     */
    protected function initDebug()
    {
        $config = $this->di->get('config');
        $debug = (isset($config->app->debug)) ? (bool) $config->app->debug : false;

        if ($debug) {
            require_once __DIR__ . '/Debug.php';
        }
    }

    /**
     * get the service name to be called
     *
     * @param $service
     * @return string
     */
    private function serviceName($service)
    {
        return 'init' . ucfirst($service);
    }
}
