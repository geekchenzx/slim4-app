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
    protected $db = null;
    public function __construct(Container $container)
    {
        $this->db = $container->get('db');
    }
}