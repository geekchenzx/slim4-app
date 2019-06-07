<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-06-07
 * Time: 12:37
 */

$app->get('/', \App\Http\Controllers\IndexController::class . ':index');
$app->get('/db', \App\Http\Controllers\IndexController::class . ':db');