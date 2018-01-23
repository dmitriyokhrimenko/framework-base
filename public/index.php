<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 22.01.2018
 * Time: 21:57
 */
$query =  rtrim($_SERVER['QUERY_STRING'], '/');

require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';
//require '../app/controllers/Main.php';
//require '../app/controllers/Posts.php';
//require '../app/controllers/PostsNew.php.php';

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

echo "<div style='background-color: aquamarine'><h1>self::\$routes</h1>";
    debug(Router::getRoutes());
echo "</div>";

Router::dispatch($query);

//if (Router::matchRoute($query)){
//    echo "<div style='background-color: coral'><h1>self::\$route</h1>";
//        debug(Router::getRoute());
//    echo "</div>";
//}
//else echo '404';