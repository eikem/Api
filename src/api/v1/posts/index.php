<?php
include_once '../../../config/database.php';
include_once '../../../models/Post.php';
include_once 'MyApi.php';
include_once '../Api.php';

use SimpleApi\MyApi;
use SimpleApi\Api;
use SimpleApi\Database;

$request = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

// Instantiate DB & connect
$database = new Database();
$db = $database->getConnection();

 // Instantiate DB & connect
$api = new MyApi($db);
$api->processAPI();

?>



