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
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url)
    {
        if(self::matchRoute($url)){
            echo 'Ok!!!';
        }
        else{
            http_response_code(404);
            include '404.html';
        }
    }
}