<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of POSTS
 *
 * @author EM
 */


namespace SimpleApi;

use SimpleApi\Database;
use PDO;


class Post {
    
    
    // db table
    private $table = 'posts';
    
    // db connection
    private $conn;
    
    // table columns
    public $id;
    public $title;
    public $body;
    
    
    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }
        
    public function create(){
        
        // create query   
        $sql = 'INSERT INTO ' .$this->table .' SET title = :title, body= :body, author = :author, category_id = :category_id ';
        
        // prepare statement
        $stmt = $this->conn->prepare($sql);
        
        // Bind param
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        
        // execute statement
        if ($stmt->execute()){
            return true;
        }
        
        return false;
    }
    
    public function read(){
        
        // create query      
        $sql = 'SELECT 
                    c.name as category_name, 
                    p.id, p.category_id, p.title, 
                    p.body, p.author, p.created_at
                FROM ' . $this->table . ' p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                ORDER BY
                    p.created_at DESC';
        
        // prepare statement
        $stmt = $this->conn->prepare($sql);
        
        //execute statement
        $stmt->execute();
        
        //return statement
        return $stmt;
    }
    
    public function readSingle(){
       
        //create query
        $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                                    FROM ' . $this->table . ' p
                                    LEFT JOIN
                                      categories c ON p.category_id = c.id
                                    WHERE
                                      p.id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();
       //return statement
        return $stmt;
        
    }
    
    public function update(){
        
      
        // create query
        $sql = 'UPDATE '. $this->table .'
                SET 
                    title = :title, body = :body, author = :author
                WHERE 
                    id = :id';
        
        // prepare statement
        $stmt= $this->conn->prepare($sql);
      
        // bind params
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        
        // execute statement
        if($stmt->execute()){
            return true;
        }
        
        return false;
    }
    
    public function delete(){
        
        // create query
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
 
        // prepare query
        $stmt = $this->conn->prepare($query);
 
        // sanitize param
        $this->id=htmlspecialchars(strip_tags($this->id));
 
        // bind param
        $stmt->bindParam(1, $this->id);
 
        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
        
    }
    
    
    
    
}
