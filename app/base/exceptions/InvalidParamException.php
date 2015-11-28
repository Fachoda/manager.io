<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 20:22
 */

namespace app\base\exceptions;

use Phalcon\Exception;

class InvalidParamException extends Exception
{
    public function getName()
    {
        return 'Invalid parameter';
    }
}