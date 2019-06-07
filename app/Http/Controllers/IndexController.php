<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-06-07
 * Time: 12:08
 */

namespace App\Http\Controllers;

use DI\Container;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class IndexController extends Controller
{
    public function index(Request $request, Response $response) {
        $response->getBody()->write('这是主控制器');
        return $response;
    }
    public function db(Request $request, Response $response) {
        $data = $this->db->select('user', ['id', 'username', 'password']);
        var_dump($data);
        return $response;
    }

}