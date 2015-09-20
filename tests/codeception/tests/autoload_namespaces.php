<?php

$appDir = dirname(dirname(__FILE__));
$baseDir = dirname(dirname($appDir));

return [
    'app\api'       => [$baseDir],
    'app\backend'   => [$baseDir],
    'app\common'    => [$baseDir],
    'app\console'   => [$baseDir],
    'app\frontend'  => [$baseDir],
    'tests\manager'   => [$appDir],
    'tests\frontend'   => [$appDir],
    'tests\backend'   => [$appDir],
    'tests\console'   => [$appDir],
    'tests\api'   => [$appDir],
    'tests\common'   => [$appDir],
];
