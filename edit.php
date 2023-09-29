<?php
include("header.php");
if (!isset($_SESSION['auth'])) {
    header("location:index.php");
    die;
}

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    $tasks = json_decode(file_get_contents("data/task.json"), true);

    $task = null;
    foreach ($tasks as $taskItem) {
        if ($taskItem['id'] == $taskId && $taskItem['user_id'] == $_SESSION['auth']['id']) {
            $task = $taskItem;
            break;
        }
    }

    if ($task === null) {
        $_SESSION['errors'][] = "Task not found.";
        header("location:edit.php");
        exit();
    }
} else {
    $_SESSION['errors'][] = "Invalid task ID.";
    header("location:edit.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>

<body>
    <div class="container mb-3 p-5">
        <div class="row align-items-center mb-4">
            <div class="col-12 p-2 mx-auto mb-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Edit Task</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION['errors'])) {
                            ?>
                            <ul>
                                <div class="alert alert-danger ">
                                    <div class="container">
                                        <?php
                                        foreach ($_SESSION['errors'] as $error) {
                                            echo "<li>$error</li>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </ul>
                            <?php
                            unset($_SESSION['errors']);
                        }
                        ?>
                               <?php
            if(isset($_SESSION['same'])){
                ?>
                <ul>
                <div class="alert alert-danger ">
                    <div class="container">
                    <?php
                        foreach($_SESSION['same'] as $success){
                            echo "<li>$success</li>";
                        }
                    ?>
                    </div>
                </div>
                </ul>
                <?php
            }
            unset($_SESSION['same']);
        ?>
                        <form action="logic/editvalidations.php" method="POST">
                            <input type="hidden" name="id" value="<?= $task['id'] ?>">
                            <div class="form-group col-md=8 mb-3 text-center">
                                <input type="text" class="form-control" name="name" value="<?= $task['name'] ?>" placeholder="Enter The Task Name">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="text-center col-md-4 btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>