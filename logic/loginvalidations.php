<?php
if(!isset($_SESSION['auth'])){
    header("location:../index.php");
}
include("../header.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    include("../functions/functions.php");
    $users=json_decode(file_get_contents("../data/user.json"),true);
    foreach($_POST as $key => $val) $$key = sanitizeInput($val);
    $error=[];
    $found=false;
        foreach($users as $user){
            if($user['email']===$_POST['email']&&password_verify($_POST['password'],$user['password'])){
               $_SESSION['auth']=$user;
                $found=true;
                break;
            }
        }
    }
            if($found){
                header("location:../todo.php");
                exit();
            }else{
                $_SESSION['errors']=["Sorry , Invalid Email or Password"];
                header("location:../index.php");
                exit();
            }