<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-06-07
 * Time: 12:35
 */

$container->set('person', function () {

    return new \App\test\Person();
});