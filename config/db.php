<?php

use app\support\helpers\Env;
use app\support\helpers\Str;

return [
    'class' => 'yii\db\Connection',
    'dsn' => Str::replacePlaceholder('{schema}:host={host};dbname={db}', [
    	'schema' => Env::get('DB_CONNECTION'),
    	'host'   => Env::get('DB_HOST'),
    	'dbname' => Env::get('DB_DATABASE'),
    ]),
    'username' => Env::get('DB_USERNAME'),
    'password' => Env::get('DB_PASSWORD'),
    'charset' => 'utf8mb4',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600*12,
    'schemaCache' => 'cache',
];
