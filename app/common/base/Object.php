<?php

namespace app\common\base;

/**
 * base class to be inherited from
 *
 * Class Object
 * @package app\common\base
 */
class Object
{
    /**
     * Returns the called class name
     *
     * @return string
     */
    public static function className()
    {
        return get_called_class();
    }
}
