<?php

//makes all application to accept the json format

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Methods: PUT");

header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-With");

//fetch connection
include_once './db.php';
$conec         = new Connection();
$db = $conec->connect();

 $response = array();



    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

      parse_str(file_get_contents('php://input'), $_PUT);

      

      //store parameters in variables

      $id = $_PUT['id'];
      $Title = $_PUT['Title'];
      $Description = $_PUT['Description'];

      


      // we have all parameters

      $stmt = $db->prepare("UPDATE todo SET Title = :Title , Description = :Description WHERE id = :id ");

      $stmt->bindParam(':id', $id);
      $stmt->bindParam(':Title', $Title);
      $stmt->bindParam(':Description', $Description);
      

      //execute query
      if ($stmt->execute()) {

        //  $response = json_decode(file_get_contents("php://input"), true);

        //success
        $response['error'] = false;
        $response['message'] = "Todo updated successfully";
      } else {

        $response['error'] = true;
        $response['message'] = "fail to insert a Todo to the database";
      }
    } else {
      //we cannot insert a todo that doesn't have all of this info
      $response['error'] = true;
      $response['message'] = "Please provide all parameters";
    }

    echo json_encode($response);
