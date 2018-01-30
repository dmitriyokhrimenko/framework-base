<?php

namespace vendor\core\base;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Model
{
    protected $pdo;
    protected $table;
    
    public function __construct() 
    {
        $this->pdo = Db::instance();
    }
    
    public function query($sql) 
    {
        return $this->pdo->execute();
    }
    
    public function findAll()
    {
        $sql = "SELECT * FROM ($this->table)";
        return $this->pdo->query($sql);
    }
}