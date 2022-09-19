<?php

include "includes/config.php";

session_start();
if (!isset($_SESSION["user_email"])) {
    header("Location: index.php"); 
    die();
}

if (isset($_GET["id"])) {
    $todoId = mysqli_real_escape_string($conn, $_GET["id"]);
} else {
    header("Location: todos.php");
}

$msg = "";

  // Update todo
  $sql = "UPDATE todos SET checked='1', date= CURRENT_TIMESTAMP WHERE ID='{$todoId}'";
  $res = mysqli_query($conn,$sql);
  if ($res) {
    $_POST["checked"] = "";
    header("Location: todos.php");
  } else {
    $msg = "<div class='alert alert-danger'>Todo failed to update</div>";
  }


//Get user id based on email
$sql = "SELECT id FROM users WHERE email='{$_SESSION["user_email"]}'";
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
if ($count >0) {
  $row =mysqli_fetch_assoc($res);
  $user_id = $row["id"];
  
} else {
  $user_id = 0;
}

$sql = "SELECT * FROM todos WHERE id='{$todoId}' AND user_id='{$user_id}'";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    $todoData = mysqli_fetch_assoc($res);
} else {
    header("Location: todos.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <?php getHeader(); ?>
  </head>

  <body class="bg-light">
    <?php getHeader2(); ?>
    
    <div class="container py-5">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card bg-white rounded border shadow">
                  <div class="card-header px-4 py-3">
                    <h4 class="card-title">Edit To Do</h4>
                  </div>
                  <div class="card-body p-4">
                    <?php echo $msg; ?>
                      <form action="" method="POST">
                        <div class="mb-3">
                          <label for="Title" class="form-label">Title</label>
                          <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Work out" value="<?php echo $todoData['title']; ?>" required>
                        </div>
                        
                        <div>
                          <button type="submit" name="donetodo" class="btn btn-primary me-2">Done</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>
