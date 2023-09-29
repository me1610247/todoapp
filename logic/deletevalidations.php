<?php
session_start();
if(!isset($_SESSION['auth'])){
    header("location:../index.php");
    die;
}

if(isset($_GET['id'])){
    $taskId = $_GET['id'];
    
    $tasks = json_decode(file_get_contents("../data/task.json"), true);

    $taskIndex = null;
    foreach($tasks as $index => $task){
        if($task['id'] == $taskId){
            $taskIndex = $index;
            break;
        }
    }

    if($taskIndex !== null){
        array_splice($tasks, $taskIndex, 1);

        file_put_contents("../data/task.json", json_encode($tasks,JSON_PRETTY_PRINT));

        $_SESSION['delete_success'] = ["Task deleted successfully."];
    } else {
        $_SESSION['errors'][] = ["Task not found."];
    }
} else {
    $_SESSION['errors'][] = ["Invalid task ID."];
}

header("location:../todo.php");