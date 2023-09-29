<?php
include("../functions/functions.php");
if(!isset($_SESSION['auth'])){
    header("location:../index.php");
}
include ("../header.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    $users=json_decode(file_get_contents("../data/user.json"),true);
    foreach($_POST as $key => $value) $$key=sanitizeInput($value);
    $error=[];
    if(!requiredVal($name)) 
    $error[]="Name is Required please";
    elseif(!requiredVal($email)) 
    $error[]="Email is Required please";
    elseif(!requiredVal($password)) 
    $error[]="Password is Required please";
    elseif(!minValue($password,4))
     $error[]="Password Must Be More Than 4 Chars";
    elseif(!maxValue($password,25))
     $error[]="Password Must Be Less Than 25 Chars";
    elseif(!validMail($email)) 
     $error[]="Please Enter a Valid Email";
    elseif($_POST['password']!=$_POST['confirmpassword'])
    $error[]="Password Doesn't Match !";
    foreach($users as $user){
        if($user['email']==$_POST['email']){
        $error[]="Email Already Exist , Try Another One";
        }
    }
    if (!empty($error)){
        $_SESSION['errors']=$error;
        header("location:../register.php");
        die;
    }else{
            $users=json_decode(file_get_contents("../data/user.json"),true);
            $_SESSION['auth']=$users;
            $userID=isset($users) && !empty($users) ? end($users)['id'] : 0;
            $newUserID=$userID +1;
            $newUser=[
               'id'=>$newUserID,
               'name'=>$name,
               'email'=>$email,
               'password'=>password_hash($password,PASSWORD_DEFAULT),
            ];
            $users[]=$newUser;
            file_put_contents("../data/user.json",json_encode($users,JSON_PRETTY_PRINT));
         $_SESSION['successed']=['Registeration Successfully , please login first so you can add tasks'];
            header("location:../index.php");
        }
    }
