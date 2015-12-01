<?php

$appDir     = dirname(dirname(__FILE__));
$baseDir    = dirname($appDir);

return [
    'app\base'      => [$baseDir],
    'app\hrm'       => [$baseDir],
    'app\pm'        => [$baseDir],
    'app\core'      => [$baseDir],
];
