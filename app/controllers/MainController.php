<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 23.01.2018
 * Time: 21:00
 */
namespace app\controllers;

use app\models\Main;

class MainController extends AppController
{    
    public function indexAction()
    {
        $var = "Hello World!";
        $this->set(compact('var'));
        //$model = new Main;
    }
}