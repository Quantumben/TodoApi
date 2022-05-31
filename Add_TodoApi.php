<?php
//makes all application to accept the json format
header('Content-Type: application/json');

//fetch connection
include_once './db.php';
$conec         = new Connection();
$db = $conec->connect();

$response = array();

//title , storyline, box_office , stars, lang, genre , release date, run_time


//id -> will be created by the db

if ( isset($_POST['Title']) 
&& isset($_POST['Description'])
  ){


//store parameters in variables
$Title = $_POST['Title'];
$Description = $_POST['Description'];


// we have all parameters


$stmt = $db->prepare("INSERT INTO todo (Title,Description)
	values(:Title,:Description) ");


$stmt->bindParam(':Title', $Title);
$stmt->bindParam(':Description', $Description);

//execute query
if($stmt->execute()){
//success
$response['error'] = false;
$response['message'] = "Todo inserted successfully";


}else{

  $response['error'] = true;
  $response['message'] = "fail to insert a Todo to the database";
  

}
  }else{
//we cannot insert a todo that doesn't have all of this info
  $response['error'] = true;
  $response['message'] = "Please provide all parameters";
  


  }

  echo json_encode($response);
