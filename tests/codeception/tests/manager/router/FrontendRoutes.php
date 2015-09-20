<?php

/**
 * define the routes used in frontend
 */

namespace tests\manager\router;

use Phalcon\Mvc\Router\Group;

class FrontendRoutes extends Group
{
    public function initialize()
    {
        //set default paths
        $this->setPaths([
            'module' => 'frontend',
            'namespace' => 'app\frontend\controllers'
        ]);

        //add the base route
        $this->add('/:controller/:action/:params', [
            'controller'    => 1,
            'action'        => 2,
            'params'        => 3
        ]);

        $this->addCustomRoutes();
        $this->addManualRoutes();
    }

    protected function addCustomRoutes()
    {
        $routes = require_once(__DIR__ . '/routes/frontend.php');

        foreach ($routes as $alias => $options) {
            $route = $this->add($alias, $options['route']);
            if (isset($options['http']) && !empty($options['http'])) {
                $route->via($options['http']);
            }
        }
    }

    protected function addManualRoutes()
    {
        return true;
    }
}