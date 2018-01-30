<?php

namespace vendor\core;
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 22.01.2018
 * Time: 22:11
 */

use vendor\core\base\Controller;

class Router
{
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
                $route['action'] = self::lowerCamelCase($route['action']);
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if(self::matchRoute($url)){
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
            if (class_exists($controller)){
                $cObj = new $controller(self::$route);
                $action = self::$route['action'] . 'Action';

                if(method_exists($cObj, $action)){
                    $cObj->$action();
                    $cObj->getView();
                }
                else echo "<div style='background-color: crimson'>Action <i><b>$action</b></i> isn`t allow at Controller <i><b>$controller</b></i></div>";
            }
            else  echo "<div style='background-color: firebrick'>Controller <b>$controller</b> not found</div>";
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

    protected static function removeQueryString($url)
    {
        if ($url){
            $params = explode('&', $url);
                if (strpos($params[0], '=') === false){
                    return rtrim($params[0], '/');
                }
                else{
                    return '';
                }
        }
    }
}