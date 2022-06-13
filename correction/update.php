<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once './db.php';
    include_once './function.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Todo($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    // Todo values
    $item->Title = $data->Title;
    $item->Description = $data->Description;
    $item->id = $data->id;
    
    if($item->updateTodo()){
        echo json_encode("Todo data updated.");
    } else{
        echo json_encode("Todo could not be updated");
    }
?>