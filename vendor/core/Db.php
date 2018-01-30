<?php

namespace vendor\core;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Db 
{
    
    protected $pdo;
    protected static $instance;
    
    protected function __construct() 
    {
        $db = ROOT . '/config/db.php';
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass']);
    }
    
    public static function instance()
    {
        if(self::$instance === NULL){
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public function execute($sql) 
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }
    
    public function query($sql) 
    {
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute();
        if($res !== false){
            return $stmt->fetchAll();
        }
        return [];
    }
}