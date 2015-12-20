<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 14.12.2015
 * Time: 22:14
 */

$appDir     = dirname(dirname(__FILE__));
$baseDir    = dirname($appDir) . '/api';

return [
    $baseDir . '/collections',
    $baseDir . '/controllers',
    $baseDir . '/models',
    $baseDir . '/transformers',
    $baseDir . '/views'
];