<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:' . __DIR__  .'/database.db',
    'charset' => 'utf8',
    'on afterOpen' => function($event) {
        // $event->sender refers to the DB connection
        // var_dump($event->sender->createCommand("SELECT * FROM settings")->execute());
    }
];
