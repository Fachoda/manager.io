<?php

namespace app\base\exceptions;

/**
 * methods not implemented
 *
 * Class NotImplementedException
 * @package app\base\exceptions
 */
class NotImplementedException extends \Exception
{
    public function getName()
    {
        return 'Method not implemented';
    }
}