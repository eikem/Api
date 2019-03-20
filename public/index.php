<?php

// Grabs the URI and breaks it apart in case we have querystring stuff
//$request_uri = explode('/', $_SERVER['REQUEST_PAST'], 2);
/*
include_once '../src/config/Database.php';
include_once '../src/models/Post.php';
include_once '../src/api/v1/Api.php';
/*
use SimpleApi\Api;
use SimpleApi\Database;

// Initiiate Library
$dataSource = new Database;
$dataConnection = $dataSource->getConnection();
$api = new API($dataConnection);
$api->processApi();
*/

error_reporting(E_ALL);
ini_set('display_errors', 'on');
  require '../views/index.html';
  
/*  
 
// Switch the Method
switch ($method){
      
    case 'POST':
       
            switch ($request_uri[0]) {
                case '/posts':
                    require '../src/api/v1/posts/create.php';
                break;
                  
            }
      
    break;
      
    case 'GET':
           
            switch ($request_uri[0]) {
                // LIST of all Posts
                case '/posts':
                     echo "get all";
                    require '../src/api/v1/posts/read.php';
                break;
                // Specific Post
                case '/posts/{:id}':
                    echo "get single";
                    require '../src/api/v1/posts/read_single.php';
                break;        
            }
            
    break;  

    case 'PUT':
                    
        break;
    
    case 'DELETE':
             
            
            require '../src/api/v1/posts/read_single.php';
              
        break;
  }
*/