<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-07-28
 * Time: 23:22
 */

namespace App\extend;
use DI\Container;

// 基础控制器
class Controller
{
    // 整合medoo
    protected $db = null;

    // Twig模板引擎
    protected $view = null;
    public function __construct(Container $container)
    {
        $this->db = $container->get('db');
        $this->view = $container->get('view');
    }
}