<?php

/**
 * manager/Routes.php
 *
 * Route provider class
 */

namespace tests\manager;

use Phalcon\Config as PhConfig;
use Phalcon\Mvc\Router as PhRouter;

class Router
{
    /**
     * get the routes used in the application
     *
     * @return array
     */
    protected function provider()
    {
        return [
            [
                'route' => '/:controller/:action',
                'params' => [
                    'module'        => 'frontend',
                    'controller'    => 1,
                    'action'        => 2
                ],
                'verbs' => ['GET', 'POST']
            ],
            [
                'route' => '/admin',
                'params' => [
                    'module'        => 'backend',
                    'controller'    => 'index',
                    'action'        => 'index'
                ],
                'verbs' => ['GET', 'POST']
            ],
            [
                'route' => '/admin/:controller/:action',
                'params' => [
                    'module'        => 'backend',
                    'controller'    => 1,
                    'action'        => 2
                ],
                'verbs' => ['GET', 'POST']
            ]
        ];
    }

    /**
     * add a new route
     *
     * @param PhRouter $router
     * @param $route
     * @param $params
     * @return PhRouter\RouteInterface
     */
    public function addRoute(PhRouter &$router, $route, $params)
    {
        $route = $router->add($route, $params);
        return $route;
    }

    /**
     * Get the alias for a route or null if no alias provided
     *
     * @param $settings
     * @return null
     */
    protected function getAlias($settings)
    {
        return isset($settings['alias']) ? $settings['alias'] : null;
    }

    /**
     * set an alias for a route if provided
     *
     * @param PhRouter\RouteInterface $route
     * @param $alias
     */
    public function setAlias(PhRouter\RouteInterface $route, $alias)
    {
        if ($alias === null || trim($alias) === '') {
            return;
        }

        $route->setName($alias);
    }

    /**
     * Get the http methods for a route or null if no methods are provided
     *
     * @param $settings
     * @return null
     */
    protected function getHttpMethods($settings)
    {
        return isset($settings['verbs']) ? $settings['verbs'] : null;
    }

    /**
     * set the http methods through which a route can be accessed
     *
     * @param PhRouter\RouteInterface $route
     * @param $methods
     * @return PhRouter\RouteInterface
     */
    public function setHttpMethods(PhRouter\RouteInterface $route, $methods)
    {
        if ($methods === null || empty($methods)) {
            return;
        }

        $route->setHttpMethods($methods);
    }

    /**
     * initialize the router component
     *
     * @return Router
     */
    public function init()
    {
        $router = new PhRouter();

        $router->setDefaultModule('frontend');

        $routes = $this->provider();
        foreach($routes as $settings) {
            $route = $this->addRoute($router, $settings['route'], $settings['params']);
            $this->setAlias($route, $this->getAlias($settings));
            $this->setHttpMethods($route, $this->getHttpMethods($settings));
        }

        return $router;
    }
}