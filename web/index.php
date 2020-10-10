<?php

use hiqdev\composer\config\Builder;

require __DIR__ . '/../vendor/autoload.php';

$config = require Builder::path('web');

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

(new yii\web\Application($config))->run();
