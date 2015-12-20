<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 20.12.2015
 * Time: 19:25
 */

namespace app\base\helpers;


use app\base\exceptions\InvalidConfigException;

class Builder
{
    public static function createObject($options)
    {
        if (!isset($options['class'])) {
            throw new InvalidConfigException('No class given');
        }

        $class = $options['class'];
        unset($options['class']);

        return static::build($class, $options);
    }

    protected static function build($class, $dependencies)
    {
        $reflection = new \ReflectionClass($class);

        return $reflection->newInstanceArgs($dependencies);
    }
}