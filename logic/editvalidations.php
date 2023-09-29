<?php
if(!isset($_SESSION['auth'])){
    header("location:../index.php");
}
session_start();

if (!isset($_SESSION['auth'])) {
    header("location: ../index.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate the form data
    $errors = array();

    // Validate task name
    if (empty($_POST["name"])) {
        $errors[] = "Task name is required.";
    } else {
        $name = $_POST["name"];
    }

    // If there are errors, redirect back to the edit page with the error messages
    if (!empty($error)) {
        $_SESSION['errors'] = $errors;
        header("location: ../edit.php?id=" . $_POST['id']);
        exit();
    }

    // Get the task ID from the form
    $taskId = $_POST['id'];

    // Load the task data
    $tasks = json_decode(file_get_contents("../data/task.json"), true);

    // Find the task with the given ID
    $taskIndex = null;
    foreach ($tasks as $index => $taskItem) {
        if ($taskItem['id'] == $taskId && $taskItem['user_id'] == $_SESSION['auth']['id']) {
            $taskIndex = $index;
            break;
        }
    }

    // If the task is found, update its name
    if ($taskIndex !== null) {
        
        $tasks[$taskIndex]['name'] = $name;

        // Save the updated task data
        file_put_contents("../data/task.json", json_encode($tasks,JSON_PRETTY_PRINT));

        // Redirect back to the index page with success message
        $_SESSION['edit_success'] = ["Task updated successfully."];
        header("location: ../todo.php");
        exit();
    } else {
        // Task not found or doesn't belong to the current user
        $_SESSION['errors'] = ["Task not found."];
        header("location: ../todo.php");
        exit();
    }
} else {
    header("location: ../todo.php");
    exit();
}