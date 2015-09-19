<?php

namespace app\common\helpers;

use Phalcon\Mvc\View\Engine\Volt;

class VoltHelper
{
    /**
     * register custom volt function to use in frontend
     *
     * @param $view
     * @param array $functions
     */
    public static function registerViewFunctions(Volt &$view, array $functions = [])
    {
        $compiler = $view->getCompiler();

        foreach ($functions as $name => $body) {
            $compiler->addFunction($name, $body);
        }
    }

    /**
     * collection of useful functions for volt engine
     *
     * @param array $list
     * @return array
     */
    public static function getUtil(array $list = [])
    {
        $utils = [
            'ng' => function ($input) {
                return '"{{".' . $input . '."}}"';
            }
        ];

        if (!empty($list)) {
            return array_filter($utils, function ($key) use ($list) {
                return in_array($key, $list);
            }, ARRAY_FILTER_USE_KEY);
        }

        return $utils;
    }
}
