<?php
include("header.php");
if(!isset($_SESSION['auth'])){
    header("location:index.php");
    die;
}
$tasks=json_decode(file_get_contents("data/task.json"),true);
    if($tasks!=null){
        foreach($tasks as $task){
            if($task['user_id']==$_SESSION['auth']['id']){
                $myTasks[]=$task;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container mb-3 p-5">
        <div class="row align-items-center mb-4">
            <div class="col-12 p-2 mx-auto mb-3">
                <div class="card">
                <div class="card-header text-center">
                    <h2>TODO LIST</h2>
                </div>
                <div class="card-body">
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
            if(isset($_SESSION['add_success'])){
                ?>
                <ul>
                <div class="alert alert-success ">
                    <div class="container">
                    <?php
                        foreach($_SESSION['add_success'] as $success){
                            echo "<li>$success</li>";
                        }
                    ?>
                    </div>
                </div>
                </ul>
                <?php
            }
            unset($_SESSION['add_success']);
        ?>
                <?php
            if(isset($_SESSION['delete_success'])){
                ?>
                <ul>
                <div class="alert alert-danger ">
                    <div class="container">
                    <?php
                        foreach($_SESSION['delete_success'] as $success){
                            echo "<li>$success</li>";
                        }
                    ?>
                    </div>
                </div>
                </ul>
                <?php
            }
            unset($_SESSION['delete_success']);
        ?>
                <form action="logic/todovalidations.php" method="POST" >
  <div class="form-group col-md=8 mb-3 text-center">
    <input type="text" class="form-control" name="name" id="" placeholder="Enter The Task Name">
  </div>
  <div class="text-center">
  <button type="submit" class="text-center col-md-4 btn btn-primary">Add</button>
  </div>
</form>
            <table class="table  table-hover">
  <thead>
    <tr>
      <th scope="col">ID Task</th>
      <th scope="col">Task Name</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($myTasks as $task){
    ?>
    <tr>
      <td><?= $task['id'] ?></td>
      <td><?= $task['name'] ?></td>

      <td class="col block-inline">
<a class="text-decoration-none btn btn-primary px-2 mx-auto" href="edit.php?id=<?= $task['id'] ?>">Edit</a>
        <a class="text-decoration-none btn btn-danger p-2" href="logic/deletevalidations.php?id=<?= $task['id'] ?>">Delete</a>      </td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
</table>

</div>

</div>
            </div>
            <div class="card  mb-5">
  <div class="card-header text-center">
    <h3>Info</h3>
  </div>
  <div class="card-body">
    <h5 class="">Name : <?= ucwords($_SESSION['auth']['name']) ?></h5>
    <h5 class="">Email : <?= $_SESSION['auth']['email'] ?> </h5>
    <h5 class="">ID : <?= $_SESSION['auth']['id'] ?> </h5>
    <div class="text-center">
    <a href="logout.php" class=" btn btn-danger">Log Out</a>
    </div>
  </div>
</div>
        </div>
    </div>
</body>
</html>
