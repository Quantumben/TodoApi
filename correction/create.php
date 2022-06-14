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

    // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $item->Title = $data->Title;
  $item->Description = $data->Description;
  

  // Create post
  if($item->createTodo()) {
    echo json_encode(
      array('message' => 'Todo Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Todo Not Created')
    );
  }
?>


