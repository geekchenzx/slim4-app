<?php
// Env文件读取
function env($key, $default = '')
{
    return  \Env::get($key, $default);
}