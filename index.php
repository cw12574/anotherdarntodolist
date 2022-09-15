

<?php
include "includes/config.php";
session_start();

if (isset($_SESSION["user_email"])) {
    header("Location: todos.php"); 
    die();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <?php getHeader(); ?>
  </head>
  <body>

    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5"> 
          <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">The most motivating way to get shit done.</h1>
            <p class="col-lg-10 fs-4">Sign up now for free. The app automatically populates the day's todos with the tasks from your morning routine, and allows you to add additional todos. When you cross somethign off the list, the list stays in the same order, because studies have shown we get a sense of satisfaction from working through an ordered list.</p>
          </div>
          <div class="col-md-10 mx-auto col-lg-5">
            <form action="login.php" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
              <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" name ="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
              <div class="checkbox mb-3">
                <label>
                  <input type="checkbox" value="remember-me"> Remember me (recommended, so you don't have to log in to your Todo List every time)
                </label>
              </div>
              <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Continue</button>
              <hr class="my-4">
              <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
            </form>
          </div>
        </div>
      </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>