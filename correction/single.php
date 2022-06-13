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

    $single = new Todo($db);
    $single->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $single->getSingleTodo();
    if($single->Title != null){
        // create array
        $emp_arr = array(
            "Title" =>  $single->Title,
            "Description" => $single->Description,
            
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Todo not found.");
    }
?>