<?php

use app\components\core\Path;
use app\support\helpers\Env;

$path = new Path();
$path->basePath = dirname(__DIR__);

return [
	'class'   => 'app\components\core\MonologTarget',
	'name'    => Env::get('LOG_CHANNEL', Env::get('APP_NAME')),
	'logFile' => $path->runtime('logs/app.log'),
	'format'  => "[%datetime%][%channel%][%level_name%][%trace_id%]: %message% %context% %extra%\n",
	'maxLogFiles' => 180,
	'levels' => [ 'info' ],
	'logVars' => [],
];
