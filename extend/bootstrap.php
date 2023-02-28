<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-06-07
 * Time: 12:20
 */

use DI\Container;
use Medoo\Medoo;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;

require  '../vendor/autoload.php';
$config = require "config.php";
require 'helpers.php';
require 'Env.php';
Env::loadFile();

//创建一个容器(第三方的)
$container = new Container();

// 注入数据库
$container->set('db', function () use ($config) {
    // return new Medoo($config['setting']['db']);
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($config['setting']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
});
// 注入模板引擎
$container->set('view', function () {
    return new \Slim\Views\Twig('../app/views', [
        // 模板缓存目录
        'cache' =>  '../runtime/temp',
        'auto_reload' => true,
        'debug' => true
    ]);
});

//app 工厂添加容器
AppFactory::setContainer($container);
//实例注入容器文件
$app = AppFactory::create();
// 错误中间件
$responseFactory = $app->getResponseFactory();
$errorMiddleware = new ErrorMiddleware($app->getCallableResolver(), $responseFactory, true, true, true);
$app->add($errorMiddleware);

// 引入路由文件
require __DIR__ . "/../routes/web.php";
