<?php

use app\support\helpers\Env;

return [
	'class' => 'yii\redis\Connection',
	'hostname' => Env::get('REDIS_HOST'),
	'password' => Env::get('REDIS_PASSWORD'),
	'port'     => Env::get('REDIS_PORT'),
	'retries'       => 5,
	'retryInterval' => 100, // 100 ms
	'database'      => 11,
];
