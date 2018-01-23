<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 22.01.2018
 * Time: 22:11
 */

class Router
{

//    public function __construct()
//    {
//        echo "Hello!!!";
//    }

    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    /**
     * @param string $url query string
     * @return bool
     */
    public static function matchRoute($url)
    {
        foreach(self::$routes as $pattern => $route) {
            if(preg_match("#$pattern#i", $url, $matches)){
                foreach ($matches as $k => $v){
                    if (is_string($k)){
                        $route[$k] = $v;
                    }
                }
                if(!isset($route['action'])){
                    $route['action'] = 'index';
                }
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url)
    {
        if(self::matchRoute($url)){
            $controller = self::upperCamelCase(self::$route['controller']);
            if (class_exists($controller)){
                $cObj = new $controller;
                $action = self::lowerCamelCase(self::$route['action']).'Action';
                debug($action);
                if(method_exists($cObj, $action)){
                    $cObj->$action();
                }
                else echo "Action <i><b>$action</b></i> isn`t allow at Controller <i><b>$controller</b></i>";
            }
            else  echo "Controller <b>$controller</b> not found";
        }
        else{
            http_response_code(404);
            include '404.html';
        }
    }

    protected static function upperCamelCase($classname)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $classname)));
    }

    protected static function lowerCamelCase($method)
    {
        return lcfirst(self::upperCamelCase($method));
    }
}