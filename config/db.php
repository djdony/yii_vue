<?php

return [
    'class' => 'yii\db\Connection',
    //'dsn' => 'pgsql:host=localhost;port=5432;dbname=yii2',
    'dsn' => 'pgsql:host='.env('DB_HOST').';
    port='.env('DB_PORT').';
    dbname='.env('DB_NAME'),
    'username' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD'),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
