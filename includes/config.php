<?php

// ================================= //
// Connect to heroku database //
// ================================= //

<?php 
$db_host = "eu-cdbr-west-03.cleardb.net";
$db_user = "bea369e2a41905";
$db_pass = "408dac43";
$db_name = "heroku_93ddc85983617d3";

$connect = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die("database connection error");


// ================================= //
// Database connection function //
// ================================= //

function dbConnect()
{

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "todo_list";


    $conn = mysqli_connect($hostname, $username, $password, $database) or die("Database connection failed.");
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
            <li class="nav-item"><a href="todos.php" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="add-todo.php" class="nav-link text-dark">Add To Do</a></li>
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
    $output = 
    '<div class="container input-group w-20">
        <div class="card-body" style="margin:8px">
            <div class="form-check">
                
                <input class="form-check-input" type="checkbox" name="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" name ="todoLabel" for="flexCheckDefault">'. textLimit($todo['title'], 28) .'</label>

                    <a href="delete-todo.php?id='. $todo['id']. '" style="float:right" class="btn btn-sm btn-outline-secondary">Delete</a>
                    <a href="edit-todo.php?id='. $todo['id']. '" style="float:right; margin-right:5px" class="btn btn-sm btn-outline-secondary">Edit</a>

                
                    
                   
                
            </div>    
        </div>
    </div>';

    echo $output;
}


// ================================= //
// Text limit function //
// ================================= //

function textLimit($string, $limit)
{
    if (strlen($string) > $limit) {   
    } else {
        return $string;
    }
    return substr($string, 0, $limit) . "...";
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


        




