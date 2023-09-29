<?php
if(!isset($_SESSION['auth'])){
    header("location:../index.php");
}
include("../header.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    include("../functions/functions.php");
    $error=[];
    foreach($_POST as $key => $value) $$key = sanitizeInput($value);
    if(!requiredVal($name))
    $error[]="Enter A Task please";
    elseif(!minValue($name,4))
    $error[]="Task Must Be More Than 4 Chars";
    if(!empty($error)){
    $_SESSION['errors']=$error;
    header("location:../todo.php");
    exit();
    }else{
        $tasks=json_decode(file_get_contents("../data/task.json"),true);
        $lastId=isset($tasks)&&!empty($tasks) ? end($tasks)['id']:0;
        $newID=$lastId+1;
        $newTask=[
            'id'=>$newID,
            'name'=>$name,
            'user_id'=>$_SESSION['auth']['id'],
        ];
        $tasks[]=$newTask;
        file_put_contents("../data/task.json",json_encode($tasks,JSON_PRETTY_PRINT));
        $_SESSION['add_success']=["Task Added Successfully"];
        header("location:../todo.php");
        exit();
    }
    }
