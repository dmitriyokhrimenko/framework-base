<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 22.01.2018
 * Time: 21:57
 */

error_reporting(-1);

use vendor\core\Router;

$query =  rtrim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('LAYOUT', 'default');

require '../vendor/libs/functions.php';


spl_autoload_register(function ($class){
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)){
        require_once $file;
    }
});

Router::add('^page/?(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/?(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

//echo "<div style='background-color: aquamarine'><h1>self::\$routes</h1>";
    //debug(Router::getRoutes());
//echo "</div>";

Router::dispatch($query);

//if (Router::matchRoute($query)){
//    echo "<div style='background-color: coral'><h1>self::\$route</h1>";
//        debug(Router::getRoute());
//    echo "</div>";
//}
//else echo '404';