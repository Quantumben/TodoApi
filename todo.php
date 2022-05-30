<?php

include_once('function.php');
$view = new Todo();

$todo = $view->viewTodo();

?>

<html>

<head>

	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
	<title>Todo list</title>

</head>

<body>
	<h1>Todo List</h1>

<table>
  <thead>
    <tr>
      <td>
      Todo Title
      </td>
    </tr>

    <tr>
      <td><table>
  <thead>
    <tr>
      <th>Todo Title</th>
      <th>Todo Description</th>
    </tr>
   </thead>
   <tbody>
    


     <tr>

     <?php foreach ($todo as $todos) {?>

      <td><?php echo $todos['Title']; ?></td>
       <td><?php echo $todos['Description']; ?></td>
       
     </tr>

     <?php } ?>

  </tbody>
</table>


</body>

</html>