<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 23.01.2018
 * Time: 21:17
 */

class PostsNew
{
    public function indexAction()
    {
        $controller = explode('::',__METHOD__);
        echo 'Action: ' . $controller[1] . '</br>Controller: ' . __CLASS__;
    }

    public function testAction()
    {
        $controller = explode('::',__METHOD__);
        echo 'Action: ' . $controller[1] . '</br>Controller: ' . __CLASS__;
    }

    public function testPageAction()
    {
        $controller = explode('::',__METHOD__);
        echo 'Action: ' . $controller[1] . '</br>Controller: ' . __CLASS__;
    }

    public function before()
    {
        $controller = explode('::',__METHOD__);
        echo 'Action: ' . $controller[1] . '</br>Controller: ' . __CLASS__;
    }
}