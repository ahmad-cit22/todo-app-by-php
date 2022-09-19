<?php
session_start();

print_r($_POST['taskTitle1']);

// $taskTitle = $_POST['taskTitle'];
// $taskDescription = $_POST['taskDescription'];
// // $taskSubmit = $_POST['taskSubmit'];
// $titleValid = preg_match('/^[A-z\s]*$/' , $taskTitle);

// $db_connect = mysqli_connect('localhost', 'root', '', 'todo_list');

$id = $_GET['id'];
// $_SESSION['taskID'] = $id;

// echo $_SESSION['taskID'];

//! validation starts
    if (empty($taskTitle)) {
        $_SESSION['errMsgEdit1'] = 'You must give a title for your task!';
    } elseif (!$titleValid) {
        $_SESSION['errMsgEdit1'] = 'You must use text only in task title!';
    } elseif (empty($taskDescription)) {
        $_SESSION['errMsgEdit2'] = 'You must add a description for your task!';
    } elseif (strlen($taskDescription) > 50) {
        $_SESSION['errMsgEdit2'] = 'Your task description must not be more than 50 characters!';
    } else {
        $taskEdit = "UPDATE todo_list_table SET task_title= '$taskTitle', task_description ='$taskDescription' WHERE id = $id";
        $editQry = mysqli_query($db_connect, $taskEdit);
    }


// if (isset($taskSubmit)) {
// }

// header('location: todoList.php');