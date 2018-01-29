<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 24.01.2018
 * Time: 21:53
 */

namespace vendor\core\base;


abstract class Controller
{
    public $route = [];
    public $view;

    /*
     * current layout
     * @var string
     */
    public $layout;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    public function getView()
    {
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render();
    }
}