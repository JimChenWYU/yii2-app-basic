<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\support\helpers\Env;

return [
	'name' => Env::get('APP_NAME'),
	'basePath' => dirname(__DIR__),
	'bootstrap' => [
		'log', 'path'
	],
	'components' => [
		'redis' => require __DIR__ . '/redis.php',
		'cache' => require __DIR__ . '/cache.php',
		'db'    => require __DIR__ . '/db.php',
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			'useFileTransport' => true,
		],
		'log' => [
			'targets' => [
				'monolog' => require __DIR__ . '/monolog.php',
			],
		],
		'path' => [
			'class' => 'app\components\core\Path',
		],
	],
	'params' => require __DIR__ . '/params.php',
];

