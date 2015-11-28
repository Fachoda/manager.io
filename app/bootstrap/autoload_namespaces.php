<?php

$appDir     = dirname(dirname(__FILE__));
$baseDir    = dirname($appDir);

return [

    'app\base'      => [$baseDir],
    'app\hrm'       => [$baseDir],
    'app\pm'        => [$baseDir],


    'app\api'       => [$baseDir],
    'app\backend'   => [$baseDir],
    'app\common'    => [$baseDir],
    'app\console'   => [$baseDir],
    'app\frontend'  => [$baseDir],
    'manager'   => [$appDir . '/library']
];
