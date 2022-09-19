<?php
$db_connect = mysqli_connect('localhost', 'root', '', 'todo_list');

$userID = $_GET['id'];

if ($userID != '') {
    $taskDelete = "DELETE FROM todo_list_table WHERE id='$userID'";
    $taskDeleteQry = mysqli_query($db_connect, $taskDelete);
} else {
    $taskDeleteAll = "DELETE FROM todo_list_table";
    $taskDeleteAllQry = mysqli_query($db_connect, $taskDeleteAll);
}

header('location: todoList.php');


?>