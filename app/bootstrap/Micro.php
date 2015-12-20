<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 14.12.2015
 * Time: 21:37
 */

namespace app\bootstrap;

use app\api\collections\ProjectsCollection;
use app\api\collections\TasksCollection;
use app\api\collections\TimeSheetsCollection;
use app\api\collections\UsersCollection;
use app\base\exceptions\NotImplementedException;
use app\base\helpers\FileHelper;
use Phalcon\Config as PhConfig;
use Phalcon\DI\FactoryDefault as PhFactoryDefault;
use Phalcon\Events\Manager as PhEventsManager;
use Phalcon\Loader as PhLoader;
use Phalcon\Logger as PhLogger;
use Phalcon\Logger\Adapter\File as PhLoggerFile;
use Phalcon\Logger\Formatter\Line as PhLoggerFormatter;
use Phalcon\Mvc\Collection\Manager as PhCollectionManager;
use Phalcon\Mvc\Url as PhUrl;
use Phalcon\Mvc\View as PhView;
use Phalcon\Mvc\Micro as PhMicro;
use PhalconRest\DI\FactoryDefault as PhRestFactoryDefault;
use Phalcon\Mvc\Router as PhRouter;
use PhalconRest\Middleware\NotFound as PhRestNotFound;
use PhalconRest\Middleware\Fractal as PhRestFractal;
use PhalconRest\Middleware\OptionsResponse as PhRestOptionsResponse;
use app\base\fractal\UrlQuery as PhUrlQuery;
use League\Fractal\Manager as FractalManager;

class Micro extends PhMicro
{
    /**
     * @var PhFactoryDefault
     */
    protected $di;
    protected $services = [
        'namespaces',
        'config',
        'environment',
        'fractalManager',
        'eventsManager',
        'logger',
        'router',
        'url',
        'mongo',
        'collectionManager',
        'collections'
    ];

    /**
     * run the micro application
     *
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function run()
    {
        $this->registerServices();
        $this->handle();

        $returnedValue = $this->getReturnedValue();

        if ($returnedValue !== null) {
            if (is_string($returnedValue)) {
                $this->response->setContent($returnedValue);
            } else {
                $this->response->setJsonContent($returnedValue);
            }
        }

        return $this->response;
    }

    /**
     * register the dependency injector for the app
     */
    protected function registerServices()
    {
        $this->di = new PhRestFactoryDefault();

        $this->initServices();
    }

    /**
     * initialize all the dependencies
     */
    protected function initServices()
    {
        foreach ($this->services as $service) {
            $serviceName = 'init' . ucfirst($service);
            if (method_exists($this, $serviceName)) {
                call_user_func([$this, $serviceName]);
            }
        }
    }

    /**
     * initialize the namespaces for the application
     */
    protected function initNamespaces()
    {
        $loader = new PhLoader();

        /**
         * register the component directories
         */
        $dirs = require('autoload_dirs.php');
        $loader->registerDirs($dirs);

        /**
         * register all other namespaces
         */
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
        return require(dirname(__DIR__) . '/api/config/config.php');
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

    public function initFractalManager()
    {
        /**
         * @description PhalconRest - \League\Fractal\Manager
         */
        $this->di->setShared('fractalManager', function () {
            $fractal = new FractalManager();
//            $fractal->setSerializer(new \App\Fractal\CustomSerializer());
            return $fractal;
        });
    }

    /**
     *
     */
    public function initEventsManager()
    {
        $this->di->setShared('eventsManager', function () {
            $eventsManager = new PhEventsManager();

            /**
             * NotFound handler
             */
            $eventsManager->attach('micro', new PhRestNotFound());
            /**
             * Fractal - Set includes
             */
            $eventsManager->attach('micro', new PhRestFractal(true));
            /**
             * Request - Allow OPTIONS
             */
            $eventsManager->attach('micro', new PhRestOptionsResponse());
            /**
             * Queries - Process queries
             */
            $eventsManager->attach('micro', new PhUrlQuery());

            return $eventsManager;
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
     * set the router
     *
     * @throws NotImplementedException
     */
    protected function initRouter()
    {
        $this->di->set('router', new PhRouter());
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
     * initialize a mongo database connection
     *
     * @return bool
     */
    protected function initMongo()
    {
        $config = $this->di->get('config');
        $logger = $this->di->get('logger');

        $debug = (isset($config->app->debug)) ? (bool) $config->app->debug : false;

        if (!isset($config->mongo)) {
            return false;
        }

        $this->di->set('mongo', function () use ($config, $debug, $logger) {
            $options = [
                'username'  => $config->mongo->username,
                'password'  => $config->mongo->password,
            ];

            $host = $config->mongo->host;
            $port = $config->mongo->port;
            $dbname= $config->mongo->dbname;

            $connection = new \MongoClient("mongodb://{$host}:{$port}", $options);

            return $connection->selectDB($dbname);
        });

        return true;
    }

    /**
     * initialize the collection manager
     * listen for model events
     *
     * @return bool
     */
    protected function initCollectionManager()
    {
        if ($this->di->get('mongo') === null) {
            return false;
        }

        //set the events manager also
        $this->di->set('collectionManager', function () {
            $eventsManager = $this->di->getShared('eventsManager');

            /**
             * listen for model events
             * no special events defined at this moment
             */
            $eventsManager->attach('collection', function ($event, $model) {
                return true;
            });

            $modelsManager = new PhCollectionManager($eventsManager);

            return $modelsManager;
        });

        return true;
    }

    protected function initCollections()
    {
        $this->get('/', function () {
            return 'nothing here';
        });

        $this->mount(new TimeSheetsCollection());
        $this->mount(new UsersCollection());
        $this->mount(new ProjectsCollection());
        $this->mount(new TasksCollection());

        $this->notFound(function () {
            $this->response->setStatusCode(404, "Not Found")->sendHeaders();
            echo 'This is crazy, but this page was not found!';
        });
    }
}