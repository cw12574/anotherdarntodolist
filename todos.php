<?php

include "includes/config.php";

session_start();
if (!isset($_SESSION["user_email"])) {
    header("Location: index.php"); 
    die();
}

$msg = "";

if (isset($_POST["addToDo"])) {
    $title = mysqli_real_escape_string($conn, $_POST["newtask"]);
  
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
    $sql = null;
  
    //Insert todo
    $sql = "INSERT INTO todos(title, user_id) VALUES ('$title', '$user_id')";
    $res =mysqli_query($conn,$sql);
    if ($res) {
      $_POST["title"] = "";
      $msg = "<div class='alert alert-success'>Todo created successfully</div>";
    } else {
      $msg = "<div class='alert alert-danger'>Todo failed to create</div>";
    }
  
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <?php getHeader(); ?>
    
  </head>
  <body>
    <?php getHeader2(); ?>
    <div class="container">
        <h1 class="mb-3 text-center fw-bold">To Do List</h1>
        <div class="container">
            <?php 
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
                $sql1 = "SELECT * FROM todos WHERE user_id='{$user_id}' ORDER BY id ASC";
                $res1 =  mysqli_query($conn, $sql1);
                if (mysqli_num_rows($res1) > 0) {
                    foreach ($res1 as $todo) { 
                ?>
                
                <div class="container col-lg-10 col-md-2 mb-1">
                        <?php getToDo($todo); ?>
                
                </div>
                
                  

                <?php } }
                ?>
                
               
                </form>
                </div>

                <div class="container col-lg-10 col-md-6 mb-2" style="margin-top:8px;">
                    <div class="container input-group w-20">
            
                        <form action="" style="display: inline; background-color: transparent;" class="container" method="POST">
                        
                            <input type="text" class="form-control" name ="newtask" placeholder="New task" aria-label="New task" aria-describedby="basic-addon1" value="<?php if (isset($_POST["addToDo"])) {echo$_POST["title"];} ?>" required> 

                            <button type="submit" style="margin-top: 8px; " name="addToDo" class="btn btn-primary me-2">Add</button>

                </div>     
            
             
                
            </div>
            
                </form>
                </div>
                </div> 
        </div>
   
       

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>

