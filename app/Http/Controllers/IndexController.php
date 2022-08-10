<?php

/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-06-07
 * Time: 12:08
 */

namespace App\Http\Controllers;

use App\Common\Controller;
use App\Model\Base;
use App\Model\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class IndexController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $user = User::all();
        print_r($user->toArray());

        $response->getBody()->write('这是主控制器');
        return $response;
    }

    /**
     * 整合medoo
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function db(Request $request, Response $response)
    {
        $data = $this->db->select('user', ['id', 'username', 'password']);
        $data = (new User($this->db))->get();
        var_dump($data);
        //        var_dump((new Base($this->db))->get());
        return $response;
    }

    /**
     * 整合Twig模板
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function muban(Request $request, Response $response, $args)
    {
        //        $name = $request->getAttribute('name');
        //        echo $args['name'];
        return $this->views($response, 'muban.html', [
            'name' => $args['name']
        ]);
        //           return $this->view->render($response, 'muban.html', [
        //            'name' => $args['name']
        //        ]);
    }
}
