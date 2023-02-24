<?php

/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-06-07
 * Time: 12:10
 */
return [
    'setting' => [
        // 数据库orm配置
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'site',
            'username' => 'root',
            'password' => '123123',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            'prefix' => '',
        ],

        // 模版引擎相关配置
        'twig' => [
            'template_path' => ROOT_BASE_PATH . 'app/views',
            'cache'         => ROOT_BASE_PATH . 'runtime/temp',
            'auto_reload'   => true,
            'debug'         => true
        ]
    ]

];
