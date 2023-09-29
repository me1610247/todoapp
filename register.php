<?php
include "header.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row align-items-center vh-100">
        <div class="col-5 p-2 mx-auto">
            <div class="card shadow border">
                <div class="card-body d-flex flex-column align-items-center">
                <div class="text-center" style="width: 20rem;">
                        <h5 class="card-title mb-3">Todo App</h5>
                        <?php
            if(isset($_SESSION['errors'])){
                ?>
                <ul>
                <div class="alert alert-danger ">
                    <div class="container">
                    <?php
                        foreach($_SESSION['errors'] as $error){
                            echo "<li>$error</li>";
                        }
                    ?>
                    </div>
                </div>
                </ul>
                <?php
            }
            unset($_SESSION['errors']);
        ?>
                        <form action="logic/registervalidations.php" method="POST">
                        <div class="form-group mb-3">
                            <input type="text" name="name" class="form-control" id=""  placeholder="Enter Name">
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" name="email" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter Email">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password" class="form-control" id="" placeholder="Enter Password">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="confirmpassword" class="form-control" id="exampleInputPassword1" placeholder="Confirm Your Password">
                            
                        </div>
                        <button type="submit" class="form-control btn btn-primary">Sign up</button>
                            </div>
                        </form>
                       <div class="text-center">
                        <br>
                        <a href="index.php" class="form-control btn btn-primary">Already Have An Account</a>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>