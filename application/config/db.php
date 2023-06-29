<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=octouser',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
    'enableSchemaCache' => false, //  Вместо `true` поставить `false` и обновить через Ctrl+F5 или Cmd + R (Mac OS)
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
];
