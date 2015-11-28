<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 19:49
 */

namespace app\base\core;


use Phalcon\Di;
use Phalcon\Exception;

class Error
{
    public static function normal($type, $message, $file, $line)
    {
        self::logError(
            $type,
            $message,
            $file,
            $line
        );
    }

    public static function exception(\Exception $exception)
    {
        self::logError(
            'Exception',
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            $exception->getTraceAsString()
        );
    }

    public static function shutdown()
    {
        $error = error_get_last();
        if ($error) {
            self::logError(
                $error['type'],
                $error['message'],
                $error['file'],
                $error['line']
            );
        } else {
            return true;
        }
    }

    protected static function logError($type, $message, $file, $line, $trace = '')
    {
        $di = Di::getDefault();
        $template = "[%s] %s (File: %s Line: [%s])";
        if ($trace) {
            $template .= PHP_EOL . $trace;
        }

        $logMessage = sprintf($template, $type, $message, $file, $line);
        if ($di->has('logger')) {
            $logger = $di->get('logger');
            if ($logger) {
                $logger->error($logMessage);
            } else {
                throw new Exception($logMessage);
            }
        } else {
            throw new Exception($logMessage);
        }
    }
}