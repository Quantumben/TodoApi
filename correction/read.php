<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once './db.php';
    include_once './function.php';
    

    $database = new Database();


    //RePass INTO Another Variable
    $db = $database->getConnection();

    $items = new Todo($db);

    //Getting Todo
    $stmt = $items->getTodo();

    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    
    if($itemCount > 0){
        
        $TodoArr = array();
        $TodoArr["body"] = array();
        $TodoArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "Title" => $Title,
                "Description" => $Description,
            );
            array_push($TodoArr["body"], $e);
        }
        echo json_encode($TodoArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>