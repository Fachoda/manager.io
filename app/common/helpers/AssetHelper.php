<?php

namespace app\common\helpers;

use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Assets\Filters\Cssmin;

class AssetHelper
{
    public static function registerJs(&$view, array $js = [], $collection = 'footer', $filter = true, $join = true)
    {
        $manager = $view->assets->collection($collection);

        foreach ($js as $resource) {
            $manager->addJs($resource, true, $filter);
        }

        if ($join) {
            $manager->setTargetPath('js/scripts.js')
                    ->setTargetUri('js/scripts.js')
                    ->join(true);
        }

        if ($filter) {
            $manager->addFilter(new Jsmin());
        }
    }

    public static function registerCss(&$view, array $css = [], $collection = 'header', $filter = true, $join = true)
    {
        $manager = $view->assets->collection($collection);

        foreach ($css as $resource) {
            $manager->addCss($resource, true, $filter);
        }

        if ($join) {
            $manager->setTargetPath('css/style.css')
                    ->setTargetUri('css/style.css')
                    ->join(true);
        }

        if ($filter) {
            $manager->addFilter(new Cssmin());
        }
    }
}