<?php
namespace SimpleApi;

/**
 * Description of Api
 * @author EM
 */
class Api {
  /**
     * Property: method
     * The HTTP method this request was made in, 
     * either GET, POST, PUT or DELETE
     */
    protected $requestMethod = '';
 
    /**
     * Property: args
     * Any additional URI components after the endpoint 
     * and verb have been removed, in our
     * case, an integer ID for the resource. eg: 
     * /<endpoint>/<verb>/<arg0>/<arg1>
     * or /<endpoint>/<arg0>
     */
    protected $args = Array();  
    
    protected  $methodMap = array(
                        'POST'=>'create', 
                        'GET'=>'read', 
                        'PUT'=>'update', 
                        'DELETE'=>'delete'
                    );
     
    public function __construct($dataConnection) {
        $this->conn = $dataConnection;
        $request = $_GET['request'];
      
        $this->args = explode('/', rtrim($request, '/'));
        
        if (array_key_exists(0, $this->args) 
                && !is_numeric($this->args[0])){
            $this->verb = array_shift($this->args);
        }
        if(count($this->args) >0){
            $this->id = $this->args[0];
        }    
    }
      
    public function processAPI() {
    
      if(array_key_exists($this->parseMethod(), $this->methodMap)) {
          
            $func = $this->methodMap[$this->requestMethod];
            switch ($func){
                case "read":
                    if(count($this->args) >0){         
                        $func = 'readSingle';
                    }
                    break;             
            };
        }    
     
        if((int)method_exists($this,$func) > 0){  
            $this->$func();
        }else{
            $this->response('Error code 404, Page not found',404);
        }    
    }
    
    private function parseMethod(String $method = null)
    {
        if (!$method) {
            if (isset($_SERVER['REQUEST_METHOD'])) {
                $this->requestMethod = $_SERVER['REQUEST_METHOD'];
            } else {
                $this->requestMethod = 'GET';
            }
        }
   
        return $this->requestMethod;
    }
    
}
    
    

                