
<?php

include "includes/config.php";

session_start();
if (!isset($_SESSION["user_email"])) {
    header("Location: index.php"); 
    die();
}

if (isset($_COOKIE['username'])) {
  $user = $_COOKIE['username'];
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

    $query = "SELECT MAX(ordernumber), id FROM todos";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_row($result)) {
      $maxordernumber = '';
      $maxordernumber = $row[0];
    }
    
    $sql = "INSERT INTO todos(title, user_id, ordernumber) VALUES ('$title', '$user_id', '$maxordernumber'+1)";
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
        <!-- Google tag (gtag.js) -->
         <script async src="https://www.googletagmanager.com/gtag/js?id=G-JKLVDZR9BT"></script>
          <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-JKLVDZR9BT');
          </script>

    <?php getHeader(); ?>
    <link rel="icon" href="images/favicon.ico" type="image/ico">
    <script src="jquery-3.6.0.min.js"></script>
    
  </head>
  <body>
    <?php getHeader2(); ?>

    <div class="container-fluid" style="padding-left:0">
        
        <div class="container-fluid">
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
                $sql1 = "SELECT * FROM todos WHERE user_id='{$user_id}' ORDER BY ordernumber ASC";
                $res1 =  mysqli_query($conn, $sql1);
                if (mysqli_num_rows($res1) > 0) {
                    foreach ($res1 as $todo) { 
                ?>
                
                <div class="row" style="padding-left:0;margin-bottom:5px">
                  <div class="column">
                        <?php getToDo($todo); ?>
                  
                    </div>  
                </div>                  

                <?php } }
                ?>
                
               
                
                    <div class="container" style="margin-left:0;padding-left:0">
            
                        <form action="" style="display: inline; background-color: transparent;" class="container-fluid" method="POST">
                        
                            <input type="text" class="form-control" name ="newtask" placeholder="New task" aria-label="New task" aria-describedby="basic-addon1" value="<?php if (isset($_POST["addToDo"])) {echo$_POST["title"];} ?>" required> 

                            <button type="submit" style="margin-top: 8px; margin-bottom:8px " name="addToDo" class="btn btn-primary me-2">Add</button>

                
                

                

                </div>     
            
             
                
            </div>
            
                </form>
                </div>
                </div> 
        </div>
   
       

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>

