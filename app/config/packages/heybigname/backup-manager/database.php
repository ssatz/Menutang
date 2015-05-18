<?php

return [
    'development' => [
        'type' => 'mysql',
        'host' => 'localhost',
        'port' => '3306',
        'user' => 'root',
        'pass' => 'password',
        'database' => 'test',
    ],
    'production' => [
        'type' => 'mysql',
        'host' => getenv('DB_HOST'),
        'port' => '3306',
        'user' => getenv('DB_USER'),
        'pass' => getenv('DB_PASS'),
        'database' => getenv('DB_NAME'),
    ],
];
