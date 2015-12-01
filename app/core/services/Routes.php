<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 22:01
 */

namespace app\core\services;

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
                'module'    => 'core',
                'namespace' => 'app\core\controllers'
            )
        );

        $this->setPrefix('/core');

        $this->addDefaults();
    }
}