<?php

namespace app\frontend\controllers;

use app\common\helpers\AssetHelper;

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        AssetHelper::registerJs($this, [
            'js/angular/dist/scripts/vendor.965cda38.js',
            'js/angular/dist/scripts/scripts.dfe86e8e.js'
        ]);

        AssetHelper::registerCss($this, [
            'js/angular/dist/styles/vendor.845fbbeb.css'
        ]);
    }
}