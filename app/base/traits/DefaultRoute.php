<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 22:22
 */

namespace app\base\traits;

use Phalcon\Mvc\Router as PhRouter;

trait DefaultRoute
{
    public function addDefaults()
    {
        /**
         * @var $this PhRouter
         */
        $this->add(
            '/:controller/:action/:params',
            [
                'controller'    => 1,
                'action'        => 2,
                'params'        => 3
            ]
        );

        $this->add(
            '/:controller',
            [
                'controller'    => 1,
                'action'        => 'index',
            ]
        );
    }
}