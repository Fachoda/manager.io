<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 20:23
 */

namespace app\base\exceptions;


use Phalcon\Exception;

class InvalidConfigException extends Exception
{
    public function getName()
    {
        return 'Invalid configuration';
    }
}