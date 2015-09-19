<?php

namespace app\frontend\helpers;

class VoltHelper extends \app\common\helpers\VoltHelper
{
    private static function menuItems()
    {
        return require_once(__DIR__ . '/../config/menu_items.php');
    }

    /**
     * collection of useful functions for volt engine
     *
     * @param array $list
     * @return array
     */
    public static function getUtil(array $list = [])
    {
        $utils = parent::getUtil($list);

        /**
         * insert other functions here
         */

        if (!empty($list)) {
            return array_filter($utils, function ($key) use ($list) {
                return in_array($key, $list);
            }, ARRAY_FILTER_USE_KEY);
        }

        return $utils;
    }
}