<?php

class Model{
    protected static $_connection = null;
    public function __construct(){
      if(self::$_connection == null){
        $user = 'root';
        $password = '';
        $host = 'localhost';
        $dbname = 'cardealer';
        self::$_connection =  new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
      }
    }
  }


?>