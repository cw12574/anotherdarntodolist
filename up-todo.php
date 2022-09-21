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


  $query = "SELECT ordernumber, id FROM todos WHERE id='{$todoId}'";
  $result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_row($result)) {
    $ordernumber = '';
    $ordernumber = $row[0];
    $nextordernumber = $row[0]-1;
  }

  $sql = "UPDATE todos SET ordernumber = (case when ordernumber='{$ordernumber}' then ordernumber-1 when ordernumber='{$nextordernumber}' then ordernumber+1 end), date = CURRENT_TIMESTAMP WHERE ordernumber='{$ordernumber}' or ordernumber='{$ordernumber}'-1";
  
  $res = mysqli_query($conn,$sql);


  if ($res) {
    $_POST[""] = "";
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
