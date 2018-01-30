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
    
    /*
     * current route
     * @var array
     */
    public $route = [];
    
    /*
     * current view
     * @var string
     */
    public $view;

    /*
     * current layout
     * @var string
     */
    public $layout;
    
    /*
     * user data
     * @var array
     */
    public $vars = [];

    
    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    public function getView()
    {
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
    }
    public function set($vars) {
        $this->vars = $vars;
    }
}