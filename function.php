<?php

class Todo
{




  public function addTodo()
  {

    include_once './db.php';
    $conec         = new Connection();
    $db = $conec->connect();

    if (isset($_POST['submit'])) {
      $Title = $_POST['Title'];
      $Description = $_POST['Description'];

      $insert = $db->prepare("INSERT INTO todo (Title,Description)
	values(:Title,:Description) ");

      $insert->bindParam(':Title', $Title);
      $insert->bindParam(':Description', $Description);
      $insert->execute();

      if ($insert) {
        //What you do here is up to you!
        echo "<script>alert('Input successful');</script>";
      }
    }
    return $insert;
  }

  public function viewTodo()
  {

    include_once './db.php';
    $conec         = new Connection();
    $db = $conec->connect();



    // Select query
    $sql = "SELECT * FROM todo ";

    // prepare the query
    $stmt = $db->prepare($sql);

    // execute the query
    $stmt->execute();

    $todo = $stmt->fetchAll();

    return $todo;
  }

  public function apiTodo()
  {

    //makes all application to accept the json format
    header('Content-Type: application/json');



    $response = array();

    include_once './db.php';
    $conec         = new Connection();
    $db = $conec->connect();



    // Select query
    $sql = "SELECT * FROM todo ";

    // prepare the query
    $stmt = $db->prepare($sql);

    // execute the query
    $stmt->execute();



    //$stmt->execute();

    if ($stmt->execute()) {
      //statement was executed successfully

      $todo = array(); //this array stores all of the results





      //looping through and get each single row
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) //meaning of associative array ["title" => "Joker", "storyline" =>This"] 
      {
        $todo[] = $row; //this means anytime we get a row it should be inserted into the movies array
      }

      $response['error'] = false; //this is no error
      $response['todo'] = $todo;
      $response['message'] = "Todo returned successfully";
      // $stmt->close(); //Close the database


    } else {
      //we have an error
      $response['error'] = true;
      $response['message'] = "could not execute query";
    }

    //display results
    echo json_encode($response);
  }

  public function TodoApiCreate()
  {
    //makes all application to accept the json format
    header('Content-Type: application/json');

    //fetch connection
    include_once './db.php';
    $conec         = new Connection();
    $db = $conec->connect();

    $response = array();

    //title , storyline, box_office , stars, lang, genre , release date, run_time


    //id -> will be created by the db

    if (isset($_POST['Title']) && isset($_POST['Description'])) {


      //store parameters in variables
      $Title = $_POST['Title'];
      $Description = $_POST['Description'];


      // we have all parameters

      $stmt = $db->prepare("INSERT INTO todo (Title,Description)
	values(:Title,:Description) ");


      $stmt->bindParam(':Title', $Title);
      $stmt->bindParam(':Description', $Description);

      //execute query
      if ($stmt->execute()) {
        //success
        $response['error'] = false;
        $response['message'] = "Todo inserted successfully";
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
  }

  public function updateTodo(){

	     //fetch connection
       include_once './db.php';
       $conec         = new Connection();
       $db = $conec->connect();
   

   
	$stmt = $db->$response->prepare("UPDATE todo SET Title = :Title, Description = :Description WHERE id = :id");
 
	$this->Title = htmlspecialchars(strip_tags($this->Title));
	$this->Description = htmlspecialchars(strip_tags($this->Description));
	
  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':Title', $this->Title);
  $stmt->bindParam(':Description', $this->Description);
  

	
	if($stmt->execute()){
		return true;
	}
 
	return false;
}
  }

