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
        <div class="col-6 p-2 mx-auto">
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
                        <?php
            if(isset($_SESSION['successed'])){
                ?>
                <ul>
                <div class="alert alert-success ">
                    <div class="container">
                    <?php
                        foreach($_SESSION['successed'] as $error){
                            echo "<li>$error</li>";
                        }
                    ?>
                    </div>
                </div>
                </ul>
                <?php
            }
            unset($_SESSION['successed']);
        ?>
                        <form action="logic/loginvalidations.php" method="POST">
                        <div class="form-group mb-3">
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <button type="submit" class="form-control btn btn-primary">Log in</button>
                            </div>
                        </form>
                       <div class="text-center">
                        <br>
                        <a href="register.php" class="form-control btn btn-primary">Make An Account</a>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>