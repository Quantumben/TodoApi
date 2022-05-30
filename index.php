<?php

include_once('function.php');
$createTodo = new Todo();


if ($_SERVER["REQUEST_METHOD"] == "POST"){  

	$Todo = $createTodo->addTodo($_REQUEST['Title'],$_REQUEST['Description']);  
	 
}  

?>

<html>

<head>

	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
	<title>Todo list</title>

</head>

<body>
	<h1>View Todo List</h1>
	<button type="submit"><a href="todo.php">View all Todo</a></button>

	<form method="post" action=" ">
		<p>Todo title: </p>
		<input name="Title" type="text">
		<p>Todo description: </p>
		<input name="Description" type="text">
		<br>
		<input type="submit" name="submit" value="submit">
	</form>

</body>

</html>