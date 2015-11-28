<?php

namespace app\base\helpers;

/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 28.11.2015
 * Time: 20:29
 */
class FileHelper
{
    /**
     * create directory similar to mkdir
     *
     * @param $path
     * @param int $mode
     * @param bool|true $recursive
     * @return bool
     * @throws \Phalcon\Exception
     */
    public static function createDirectory($path, $mode = 0775, $recursive = true)
    {
        if (is_dir($path)) {
            return true;
        }
        $parentDir = dirname($path);
        // recurse if parent dir does not exist and we are not at the root of the file system.
        if ($recursive && !is_dir($parentDir) && $parentDir !== $path) {
            static::createDirectory($parentDir, $mode, true);
        }
        try {
            if (!mkdir($path, $mode)) {
                return false;
            }
        } catch (\Exception $e) {
            if (!is_dir($path)) {// https://github.com/yiisoft/yii2/issues/9288
                throw new \Phalcon\Exception("Failed to create directory \"$path\": " . $e->getMessage(), $e->getCode(), $e);
            }
        }
        try {
            return chmod($path, $mode);
        } catch (\Exception $e) {
            throw new \Phalcon\Exception("Failed to change permissions for directory \"$path\": " . $e->getMessage(), $e->getCode(), $e);
        }
    }
}