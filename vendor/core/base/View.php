<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 25.01.2018
 * Time: 22:44
 */

namespace vendor\core\base;


class View
{
    /*
     * current route and parameters
     * @var array
     */
    public $route = [];

    /**
     * currennt view
     * @var string
     */
    public $view;

    /*
     * current layout
     * @var string
     */
    public $layout;

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        if($layout === FALSE){
            $this->layout = FALSE;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
        
    }

    public function render($vars)
    {
        if(is_array($vars)){
            extract($vars);
        }
        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if (is_file($file_view)){
            require $file_view;
        }
        else{
            echo "<p>Not found view <b>$file_view</b></p>";
        }
        $content = ob_get_clean();

        if($this->layout != FALSE){
            $file_layout = APP . "/views/layouts/$this->layout.php";

        if (is_file($file_layout)){
            require $file_layout;
        }
        else{
            echo "<p>Not found layout <b>$file_layout</b></p>";
            }
        }
    }
}