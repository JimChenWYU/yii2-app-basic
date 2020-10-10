<?php

use app\support\helpers\Env;

$config = [
    'id' => 'basic',
    'bootstrap' => ['urlManager'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
	        'parsers' => [
		        'application/json' => 'yii\web\JsonParser',
		        'multipart/form-data' => 'yii\web\MultipartFormDataParser',
	        ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => Env::get('APP_KEY', ''),
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => Env::get('YII_DEBUG') ? 3 : 0,
        ],
        'urlManager' => [
        	'class' => 'app\components\core\Router',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];

if (Env::get('YII_ENV_DEV')) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
