<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-07-28
 * Time: 23:22
 */

namespace App\Common;

use DI\Container;
use Psr\Http\Message\ResponseInterface;

// 基础控制器
class Controller
{
    // 整合medoo
    protected $db = null;
    // Twig模板引擎
    protected $view = null;

    protected $response = null;

    /**
     * Controller constructor.
     * @param Container $container [DI容器依赖注入]
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function __construct(Container $container)
    {
        // // 数据库依赖
        // $this->db = $container->get('db');
        // 模板引擎依赖
        $this->view = $container->get('view');
    }

    /**
     * 渲染模板
     * @param $response
     * @param $muban [模板视图]
     * @param $data [渲染数据]
     * @return mixed
     */
    public function views($response, $muban, $data)
    {
        return $this->view->render($response, $muban, $data);
    }


}