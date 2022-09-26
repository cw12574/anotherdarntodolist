

<?php
include "includes/config.php";
session_start();

if (isset($_COOKIE['username'])) {
  $_SESSION["user_email"] = $_COOKIE['username'];
}

if (isset($_SESSION["user_email"])) {
    header("Location: todos.php"); 
    die();
}



?>

<!doctype html>
<html lang="en">
  <head>

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
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5"> 
          <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-5" >The most motivating way to get shit done.</h1>
            <p class="col-lg-11 fs-4"> - A ToDo List, designed to increase motivation <br>
              - Tick off items in order so you feel a sense of progression <br>
              - In-browser so you can easily access the same list on desktop, tablet and mobile
            </p>
          </div>
          <div class="col-md-10 mx-auto col-lg-5">
            <form action="login.php" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
              <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" name ="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
              </div>
              <div class="checkbox mb-3">
                <label>
                  <input type="checkbox" name="checkbox" value="remember-me"> I agree to the <a href="terms.php"> terms of use </a>
                </label>
              </div>
              <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Continue</button>
             
              
            </form>
          </div>
        </div>
      </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>