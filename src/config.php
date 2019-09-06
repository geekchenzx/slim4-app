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
        'db'   => [
            'database_type' => 'mysql',
            'database_name' => 'site',
            'server'        => '127.0.0.1',
            'username'      => 'root',
            'password'      => '123456',
            'charset'       => 'utf8',
            'prefix'        => '',
        ],
        // 模版引擎相关配置
        'twig' => [
            'template_path' => ROOT_BASE_PATH . 'app/views',
            'cache'         => ROOT_BASE_PATH. 'runtime/temp',
            'auto_reload'   => true,
            'debug'         => true
        ]
    ]

];