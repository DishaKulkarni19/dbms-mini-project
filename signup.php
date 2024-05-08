<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $cid = $_POST["cid"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    
    // Check if any field is empty
    if(empty($cid) || empty($username) || empty($password) || empty($cpassword)) {
        $showError = "Please fill in all the fields";
    } else {
        // Check if the entered Customer ID already exists
        $sql_check = "SELECT * FROM users WHERE cid='$cid'";
        $result_check = mysqli_query($conn, $sql_check);
        if(mysqli_num_rows($result_check) > 0) {
            $showError = "This customer ID already exists";
        } else {
            // If not exists, proceed with the registration
            if($password == $cpassword) {
                $sql = "INSERT INTO `users` (`cid`,`username`, `password`, `date`) VALUES ('$cid','$username', '$password', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result){
                    $showAlert = true;
                    // Redirect to login page after successful signup
                    header("Location: login.php");
                    exit; // Make sure to exit after redirection
                }
            } else {
                $showError = "Passwords do not match";
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>SignUp</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>

    <div class="container my-4">
     <h1 class="text-center">Signup to our website</h1>
     <form action="/loginsystem/signup.php" method="post">

     <div class="form-group">
         <label for="cid">Customer id</label>
         <input type="number" class="form-control" id="cid" name="cid">
     </div>
     <div class="form-group">
         <label for="username">Username</label>
         <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
     </div>
     <div class="form-group">
         <label for="password">Password</label>
         <input type="password" class="form-control" id="password" name="password">
     </div>
     <div class="form-group">
         <label for="cpassword">Confirm Password</label>
         <input type="password" class="form-control" id="cpassword" name="cpassword">
         <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
     </div>
         
     <button type="submit" class="btn btn-primary">SignUp</button>
     </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
