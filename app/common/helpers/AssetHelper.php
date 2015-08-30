<?php

namespace app\common\helpers;

use app\common\base\Object;
use Phalcon\Assets\Filters\Jsmin;
use Phalcon\Assets\Filters\Cssmin;

class AssetHelper extends Object
{
    const ASSET_PATH_JS     = 'assets/js/';
    const ASSET_PATH_CSS    = 'assets/css/';
    const ASSET_NAME_JS     = 'scripts.%s.js';
    const ASSET_NAME_CSS    = 'styles.%s.css';

    public static $hashLength      = 5;

    /**
     * hash a value
     * if array => hash the joined elements
     * if null  => hash the 'empty' string
     * else     => hash the value
     *
     * @param $value
     * @return string
     */
    private static function hash($value)
    {
        if (is_array($value)) {
            $value = implode('', $value);
        } elseif (is_null($value)) {
            $value = 'empty';
        }

        return md5($value);
    }

    /**
     * get the name of the file asset that needs to be included in the site
     *
     * @param $asset
     * @param $sources
     * @return bool|string
     */
    protected static function buildName($asset, $sources)
    {
        $hash = substr(self::hash($sources), 0, self::$hashLength);

        switch ($asset) {
            case 'js':
                return self::ASSET_PATH_JS . sprintf(self::ASSET_NAME_JS, $hash);
                break;
            case 'css':
                return self::ASSET_PATH_CSS . sprintf(self::ASSET_NAME_CSS, $hash);
                break;
        }

        return false;
    }

    /**
     * Register the javascript files for a page, join and apply filters if needed
     *
     * @param $view
     * @param array $js
     * @param string $collection
     * @param bool $filter
     * @param bool $join
     */
    public static function registerJs(&$view, array $js = [], $collection = 'footer', $filter = true, $join = true)
    {
        $target = self::buildName('js', $js);

        if (!$target) {
            return;
        }

        $manager = $view->assets->collection($collection);

        foreach ($js as $resource) {
            $manager->addJs($resource, true, $filter);
        }

        if ($join) {
            $manager->setTargetPath($target)
                    ->setTargetUri($target)
                    ->join(true);
        }

        if ($filter) {
            $manager->addFilter(new Jsmin());
        }
    }

    /**
     * Register the css files for a page, join and apply filters if needed
     *
     * @param $view
     * @param array $css
     * @param string $collection
     * @param bool $filter
     * @param bool $join
     */
    public static function registerCss(&$view, array $css = [], $collection = 'header', $filter = true, $join = true)
    {
        $target = self::buildName('css', $css);

        if (!$target) {
            return;
        }

        $manager = $view->assets->collection($collection);

        foreach ($css as $resource) {
            $manager->addCss($resource, true, $filter);
        }

        if ($join) {
            $manager->setTargetPath($target)
                    ->setTargetUri($target)
                    ->join(true);
        }

        if ($filter) {
            $manager->addFilter(new Cssmin());
        }
    }
}
