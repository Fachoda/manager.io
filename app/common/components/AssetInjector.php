<?php

namespace app\common\components;

use app\common\base\Object;
use app\common\helpers\AssetHelper;

class AssetInjector extends Object
{
    private $instance;
    private $config;
    private $controller = 'index';
    private $action = 'index';

    public function __construct($instance)
    {
        $this->instance = $instance;
        $this->controller = $instance->router->getControllerName();
        $this->action = $instance->router->getActionName();
        $this->config = $instance->asset_config;
    }

    /**
     * Get the asset stored in module configuration
     *
     * @param $type
     * @return mixed
     */
    protected function getAsset($type)
    {
        $config = $this->config['fallback'][$type];

        if (isset($this->config[$this->controller][$this->action][$type])) {
            $config = merge_deep($config, $this->config[$this->controller][$this->action][$type]);
        }

        return $config;
    }

    /**
     * Return resources to be loaded
     * must be an array of web accessible files
     *
     * @param $assetBundle
     * @return array
     */
    protected function getResources($assetBundle)
    {
        return isset($assetBundle['resources']) ? $assetBundle['resources'] : [];
    }

    /**
     * The collection in which the bundle will be compiled
     *
     * @param $assetBundle
     * @return mixed
     */
    protected function getCollection($assetBundle)
    {
        return isset($assetBundle['collection']) ? $assetBundle['collection'] : '';
    }

    /**
     * The flags for the asset bundle
     * must be boolean
     *
     * @param $assetBundle
     * @param string $flag
     * @return mixed|('join'|'filter')
     */
    protected function getFlags($assetBundle, $flag = 'join')
    {
        return isset($assetBundle[$flag]) ? $assetBundle[$flag] : false;
    }

    /**
     * Register the javascript files for the current view
     */
    protected function registerJs()
    {
        $assetBundle = $this->getAsset('js');

        AssetHelper::registerJs(
            $this->instance,
            $this->getResources($assetBundle),
            $this->getCollection($assetBundle),
            $this->getFlags($assetBundle, 'filter'),
            $this->getFlags($assetBundle, 'join')
        );
    }

    /**
     * Register the css files for the current view
     */
    protected function registerCss()
    {
        $assetBundle = $this->getAsset('css');

        AssetHelper::registerCss(
            $this->instance,
            $this->getResources($assetBundle),
            $this->getCollection($assetBundle),
            $this->getFlags($assetBundle, 'filter'),
            $this->getFlags($assetBundle, 'join')
        );
    }

    /**
     * Load the assets for a given page
     */
    public function init()
    {
        $this->registerJs();
        $this->registerCss();
    }
}