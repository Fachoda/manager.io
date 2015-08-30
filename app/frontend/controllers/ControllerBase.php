<?php

namespace app\frontend\controllers;

use app\common\components\AssetInjector;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected $assetInjector;

    /**
     * Pre-process action
     */
    public function initialize()
    {
        $this->assetInjector = new AssetInjector($this);
        $this->assetInjector->init();
    }
}
