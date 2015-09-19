<?php

/**
 * Base controller for the frontend application
 * Every controller extends this one
 */

namespace app\frontend\controllers;

use app\common\components\AssetInjector;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected $assetInjector;

    /**
     * Compute current route
     *
     * @return string
     */
    protected function getCurrentRoute()
    {
        $currentRoute = $this->router->getControllerName();
        return $currentRoute !== null ? $currentRoute : 'index';
    }

    /**
     * Pre-process action
     */
    public function initialize()
    {
        //inject assets into page
        $this->assetInjector = new AssetInjector($this);
        $this->assetInjector->init();

        //set the current route for view purposes
        $this->view->route = $this->getCurrentRoute();
    }
}
