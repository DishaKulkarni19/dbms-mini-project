<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Admin Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <!-- <h1 class="text-center mt-5">Create Admin Account Page</h1> -->
        <!-- Add your form or content for creating admin account here -->

        <?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_create_admin.php';
    $aid = $_POST["aid"];
    $fname = $_POST["fname"];
    $mname = $_POST["mname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $add = $_POST["add"];
    $password = $_POST["password"];
    $exists=false;
    if( $exists==false){
        $sql = "INSERT INTO `create_admin` (`aid`,`fname`,`mname`,`lname`, `email`, `add`,`password`) VALUES ('$aid','$fname','$mname','$lname', '$email','$add','$password')";
       $result = mysqli_query($conn, $sql);
       if ($result){
           $showAlert = true;
           //Redirect to login page after successful signup
            header("Location: access_admin.php");
        exit; // Make sure to exit after redirection
    }
    }
     else{
         $showError = "Something is wrong";
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

    <title>Admin</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your admin account is now created
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
     <h1 class="text-center">Create your Admin account</h1>
     <form action="/loginsystem/create_admin.php" method="post">
     <div class="form-group">
            <label for="cid">Admin ID</label>
            <input type="integer" class="form-control" id="aid" name="aid" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="fname">first name</label>
            <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp">
        </div>
       
        <div class="form-group">
            <label for="mname">Middle name</label>
            <input type="text" class="form-control" id="mname" name="mname" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="lname">Last name</label>
            <input type="text" class="form-control" id="lname" name="lname" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
            <small id="emailHelp" class="form-text text-muted">Make sure to enter email in @ format</small>
        </div>
        
        <div class="form-group">
            <label for="add">Address</label>
            <input type="text" class="form-control" id="add" name="add" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password" aria-describedby="emailHelp">
        </div>
         
        <button type="submit" class="btn btn-primary">Create Admin Account</button>
     </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

        
    </div>
</body>
</html>
