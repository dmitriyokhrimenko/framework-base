<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 23.01.2018
 * Time: 21:00
 */

class Posts
{
    public function index()
    {
        $controller = explode('::',__METHOD__);
        echo 'Action: ' . $controller[1] . '</br>Controller: ' . __CLASS__;
    }
}