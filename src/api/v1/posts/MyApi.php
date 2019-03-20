<?php
namespace SimpleApi;
include_once '../Api.php';
use SimpleApi\Database;
use SimpleApi\Post as Post;
use PDO;

class MyApi extends Api {
    
    public function create(){
        
      $obj = new Post($this->conn);
        
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        if(!empty($data->title) && !empty($data->body)&&!empty($data->author)&!empty($data->category_id) ){
            $obj->title = $data->title;
            $obj->body = $data->body;
            $obj->author = $data->author;
            $obj->category_id = $data->category_id;

            // Create post
            if($obj->create()) {
                  // set response code - 201 created
                  http_response_code(201);  
                  echo json_encode(
                    array('message' => 'Post Created')
                  );
            } else {
                  // set response code - 503 service unavailable
                  http_response_code(503);  
                  echo json_encode(
                    array('message' => 'Post Not Created')
                  );
            }
        // tell the user data is incomplete
        }else{

            // set response code - 400 bad request
            http_response_code(400);

            // tell the user
            echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
        }
 
    }
    
        public function read(){

           $obj = new Post($this->conn);
            $result = $obj->read();

            // Get row count
            $num = $result->rowCount();

            // Check if any items
            if($num > 0) {
              // Items array
              $items = array();

              while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $postsItems[] = array(
                  'id' => $id,
                  'title' => $title,
                  'body' => html_entity_decode($body),
                  'author' => $author,
                  'category_id' => $category_id,
                  'category_name' => $category_name
                );

              }

              // set response code - 200 OK
              http_response_code(200);
              // Turn to JSON & output
              echo json_encode($postsItems);

            } else {
              // No Posts
              echo json_encode(
                array('message' => 'No Posts Found')
              );

            }
    }  
    
    public function readSingle(){
       
        // Instantiate blog post object
        $post = new Post($this->conn);

        // Get ID
        $post->id = $this->id;

        // Get post
        $stmt = $post->readSingle();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       
        $item = array(
        // Set properties
        'title' => $row['title'],
        'body' => $row['body'],
        'author' => $row['author'],
        'category_id' => $row['category_id'],
        'category_name' => $row['category_name']
      );
        // Make JSON
        echo (json_encode($item));      
    }
    
    public function update(){
        
        $obj = new Post($this->conn);
         // Get raw posted data
        $data = json_decode(file_get_contents("php://input"));
        // Set ID to update
        $obj->id = $data->id;
        $obj->title = $data->title;
        $obj->body = $data->body;
        $obj->author = $data->author;
        $obj->category_id = $data->category_id;
        // Update record
        if($obj->update()) {
             // set response code - 200 OK
          http_response_code(200);  
          echo json_encode(
            array('message' => 'Record Updated')
          );
        } else {
          echo json_encode(
            array('message' => 'Record Not Updated')
          );
        }
        
    }
    
    public function delete(){
        
        $obj = new Post ($this->conn);
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"));
      
        // Set ID to delete
        $obj->id = $data->id;
        
        // delete record
        if($obj->delete()){
            http_response_code(200);  
            echo json_encode(
            array('message' => 'Record deleted')
          );
        }
        else{
 
            // set response code - 503 service unavailable
            http_response_code(503);
 
            // tell the user
            echo json_encode(array("message" => "Unable to delete product."));
        }
 
    }    
}

