<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SimpleApi;

use PDO;

/**
 * Description of Database
 *
 * @author EM
 */
class Database {
    
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "api_db";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }

        return $this->conn;
    }
    
   









    //put your code here
}
