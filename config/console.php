<?php

use app\support\helpers\Env;

$config = [
    'id' => 'basic-console',
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
    	//
    ],
];

if (Env::get('YII_ENV_DEV')) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];

    if (class_exists('yii\faker\FixtureController')) {
	    $config['controllerMap'] = [
		    'fixture' => [ // Fixture generation command line.
			    'class' => 'yii\faker\FixtureController',
		    ],
	    ];
    }
}

return $config;
