<?php

// ================================= //
// Database connection function //
// ================================= //

function dbConnect()
{

    $db_host = "eu-cdbr-west-03.cleardb.net";
    $db_user = "bea369e2a41905";
    $db_pass = "408dac43";
    $db_name = "heroku_93ddc85983617d3";


    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("database connection error");
    return $conn;
}

$conn = dbConnect();

// ================================= //
// Check whether email is already in use //
// ================================= //

function emailIsValid($email)
{
    $conn = dbConnect();
    $sql = "SELECT email FROM users WHERE email ='$email'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0){
        return true;
    } else {
        return false;
    }
}

// ================================= //
// Check whether log in details are valid //
// ================================= //

function checkLoginDetails($email, $password)
{
    $conn = dbConnect();
    $sql = "SELECT email FROM users WHERE email ='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0){
        return true;
    } else {
        return false;
    }
}

// ================================= //
// Create user function //
// ================================= //

function createUser($email, $password)
{
    $conn = dbConnect();
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    $result = mysqli_query($conn, $sql);
    return $result;
    
}

// ================================= //
// Get head function //
// ================================= //

function getHeader()
{
    $pageTitle = dynamicTitle();
    $output = '<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'. $pageTitle .'</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">';
    

    echo $output;
}

// ================================= //
// Get header function 2 //
// ================================= //

function getHeader2()
{
    $output = '<header class="py-3 mb-4 border-bottom bg-white">
        <div class="d-flex flex-wrap justify-content-center container">
        <a href="todos.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            
            <span class="fs-4">Another Darn To Do List App</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="logout.php" class="nav-link bg-danger text-white">Logout</a></li>
            
        </ul>
        </div>
    </header>';

    echo $output;
}

// ================================= //
// Get todos function //
// ================================= //

function getToDo($todo)
{

    $strikethrough="";
    $checked="";

    if ($todo['checked'] == '1') {
        $strikethrough ='line-through';
        $checked = 'checked';
    } else {
        $strikethrough='';
        $checked ='';
    }

    $output = 
    '
        <div class="card-body" style="margin:8px">
            <div class="form-check" >
                <form action ="action-handler.php" method="POST">
                
                    <label class="form-check-label" style="text-decoration:'. $strikethrough .'" name ="todoLabel" for="flexCheckDefault">'. $todo['title'] .'</label>

                    
                    <a href="edit-todo.php?id='. $todo['id']. '" style="margin-right:0;margin-left:auto;display:in-line" class="btn btn-sm btn-outline-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                        </svg>
                    </a>                

                    <a href="delete-todo.php?id='. $todo['id']. '" style="margin-right:0;margin-left:auto; " class="btn btn-sm btn-outline-secondary">  
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg></a>
                    <a href="done-todo.php?id='. $todo['id']. '" style="margin-right:0;margin-left:auto;" class="btn btn-sm btn-outline-secondary">Done</a>

                </form>
                
                
            </div>    
        </div>
    ';

    echo $output;
}

// ================================= //
// Text limit function //
// ================================= //

function color($todo)
{

    $sql = "SELECT * from todos WHERE checked='1'";
    $result = mysqli_query($conn, $sql);

    if (isset($todo)) {
    } else {
        return $color='green';
    }
    return $color='red';
}

// ================================= //
// Dynamic Title function //
// ================================= //

function dynamicTitle()
{
    global $conn;
    $filename = basename($_SERVER["PHP_SELF"]);
    $pagetitle = "";
    switch($filename){
        case 'index.php':
            $pageTitle = "Home";
            break;

        case 'todos.php':
            $pageTitle = "Todos";
            break;

        case 'add-todo.php':
            $pageTitle = "Add";
            break;
    
        case 'edit-todo.php':
            $pageTitle = "Edit";
            break;

        case 'done-todo.php':
            $pageTitle = "Done";
            break;

        case 'view-todo.php':
            $todoId = mysqli_real_escape_string($conn, $_GET["id"]);
               
                $sql1 = "SELECT * FROM todos WHERE id ='{$todoId}'";
                $res1 =  mysqli_query($conn, $sql1);
                if (mysqli_num_rows($res1) > 0) {
                    foreach ($res1 as $todo) { 
            $pageTitle = $todo["title"];
                    }
                }
            break;
        
        default:
            $pagetitle = "Todo List";
            break;

    }

    return $pageTitle;
}


        




