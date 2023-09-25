<?php

return [
    'default'     => 'mysql',
    'prefix'      => 'blog_',
    'connections' => [
        'mysql' => [
            'driver'   => 'mysql',
            'hostname' => 'localhost',
            'port'     => '3306',
            'username' => 'root',
            'password' => '',
            'database' => 'blog',
            'charset'  => 'utf8mb4'
        ]
    ]
];
