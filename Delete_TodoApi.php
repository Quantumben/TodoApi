<?php
//makes all application to accept the json format
header('Content-Type: application/json');

//fetch connection
include_once './db.php';
$conec         = new Connection();
$db = $conec->connect();



$response = array();

//provide movie id

if( isset($_POST['id'])){

  //move on and delete the movie
  $id = $_POST['id'];

  $stmt = $db->prepare("DELETE FROM todo WHERE id= :id LIMIT 1");

  // $stmt = $db->prepare("DELETE FROM movies WHERE id= ? LIMIT 1");

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

  // we cannot delete the movie cos we don't knoe the movie to delete
  $response['error'] = true;
  $response['message'] = "please provide the Todo id";

}

echo json_encode($response);