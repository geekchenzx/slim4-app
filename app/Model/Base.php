<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-09-05
 * Time: 22:37
 */

namespace App\Model;


use DI\Container;
use Slim\App;

class Base
{
    protected $db = null;
    protected $app = null;
    protected $container = null;
    // 表名
    protected $table = '';
    // 显示的字段
    protected $fillable = [];

    protected $conditions = [];

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function where()
    {


    }

    public  function get()
    {
        var_dump($this->db);
//
//         return static::$db->select(static::$table, static::$fillable);
    }

}