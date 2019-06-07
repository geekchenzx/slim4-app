<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-06-07
 * Time: 12:42
 */
namespace app\Http\Controllers;

use DI\Container;

class Controller
{
    protected $db = null;
    public function __construct(Container $container)
    {
        $this->db = $container->get('db');

    }
}