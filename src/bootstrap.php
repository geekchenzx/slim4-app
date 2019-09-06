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

require ROOT_BASE_PATH . 'vendor/autoload.php';
$config = require ROOT_BASE_PATH . "src/config.php";

//创建一个容器(第三方的)
$container = new Container();

// 注入数据库
$container->set('db', function () use ($config) {
    return new Medoo($config['setting']['db']);
});
// 注入模板引擎
$container->set('view', function () {

    return new \Slim\Views\Twig(ROOT_BASE_PATH . 'app/views', [
        // 模板缓存目录
        'cache' => ROOT_BASE_PATH . 'runtime/temp',
        'auto_reload' => true,
        'debug' => true
    ]);
});

//app 工厂添加容器
AppFactory::setContainer($container);
//实例注入容器文件
require ROOT_BASE_PATH . 'src/dependencies.php';

$app = AppFactory::create();

// 错误中间件
$responseFactory = $app->getResponseFactory();
$errorMiddleware = new ErrorMiddleware($app->getCallableResolver(), $responseFactory, true, true, true);
$app->add($errorMiddleware);

// 引入路由文件
require __DIR__ . "/../routes/web.php";

