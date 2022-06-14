<?php

//makes all application to accept the json format
 header('Access-Control-Allow-Origin: *');

 header('Content-Type: application/json; charset=UTF-8');

header("Access-Control-Allow-Methods: DELETE");

 header("Access-Control-Max-Age:3600");

 header("Access-Control-Allow-Headers:*");


//fetch connection
include_once './db.php';
$conec         = new Connection();
$db = $conec->connect();



$response = array();


 //$id = $_POST['id'];


if($_SERVER['REQUEST_METHOD'] === 'GET'){

  //$id = parse_str(file_get_contents('php://input'), $_DELETE);
  
  // $response = array();

  //move on and delete the movie
  
   $id = $_GET['id'];
  

  $stmt = $db->prepare("DELETE FROM todo WHERE id= :id LIMIT 1");

  

  $stmt->bindParam(':id', $id);
// $stmt->bind_param('i', $id);

  if($stmt->execute()){  
    //success
    $response['error'] = false;
    $response['message'] = "Todo deleted successfully";
  }else{
    //failure
    $response['error'] = true;
    $response['message'] = "fail to remove a movie";
  }
}else{

  //we cannot delete the movie cos we don't knoe the movie to delete
  $response['error'] = true;
  $response['message'] = "please provide the Todo id";

}

echo json_encode($response);