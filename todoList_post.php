<?php
session_start();

$taskTitle = $_POST['taskTitle'];
$taskDescription = $_POST['taskDescription'];
$taskSubmit = $_POST['taskSubmit'];

$titleValid = preg_match('/^[A-z\s]*$/' , $taskTitle);

$db_connect = mysqli_connect('localhost', 'root', '', 'todo_list');


//validation starts

if (isset($taskSubmit)) {
    if (empty($taskTitle)) {
        $_SESSION['errMsg1'] = 'You must give a title for your task!';
    } elseif (!$titleValid) {
        $_SESSION['errMsg1'] = 'You must use text only in task title!';
    } elseif (empty($taskDescription)) {
        $_SESSION['errMsg2'] = 'You must add a description for your task!';
    } elseif (strlen($taskDescription) > 50) {
        $_SESSION['errMsg2'] = 'Your task description must not be more than 50 characters!';
    } else {
        $_SESSION['succMsg'] = 'Task added successfully!';
        $taskInsert = "INSERT INTO todo_list_table (task_title, task_description) VALUES ('$taskTitle', '$taskDescription')";
        $insertQry = mysqli_query($db_connect, $taskInsert);
    }
}

header('location: todoList.php');
