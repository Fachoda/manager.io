<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 22:01
 */

namespace app\[[module_name]]\services;

use app\base\traits\DefaultRoute;
use Phalcon\Mvc\Router\Group as PhRouterGroup;

class Routes extends PhRouterGroup
{
    use DefaultRoute;

    public function initialize()
    {
        // Default paths
        $this->setPaths(
            array(
                'module'    => '[[module_name]]',
                'namespace' => 'app\[[module_name]]\controllers'
            )
        );

        $this->setPrefix('/[[module_name]]');

        $this->addDefaults();
    }
}