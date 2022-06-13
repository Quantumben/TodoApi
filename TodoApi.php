<?php
include_once('./function.php');
$view = new Todo();

$todo = $view->apiTodo();

echo $todo;
