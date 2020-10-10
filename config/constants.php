<?php

/**
 * 常量定义
 */

use app\support\helpers\Arr;
use app\support\helpers\Env;
use hiqdev\composer\config\Builder;

$yiiConstants = [
	'YII_BEGIN_TIME',
	'YII_ENABLE_ERROR_HANDLER',

	'YII_DEBUG',
	'YII_ENV',
];

$dotenv = require Builder::path('dotenv');

foreach ($yiiConstants as $constant) {
	if (!defined($constant) && Arr::has($dotenv, $constant)) {
		define($constant, Env::format(Arr::get($dotenv, $constant)));
	}
}
unset($constant, $yiiConstants);
