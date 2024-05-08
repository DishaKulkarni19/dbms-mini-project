<?php
session_start();
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_profile.php';
   // include 'partials/_dbconnect.php';
    $cid = $_SESSION['cid'];
    $f_name = $_POST["f_name"];
    $m_name = $_POST["m_name"];
    $l_name = $_POST["l_name"];
    $email = $_POST["email"];
    $add = $_POST["add"];
    $exists = false;

    // Check if the form fields are not empty
    if (!empty($f_name) && !empty($l_name) && !empty($email) && !empty($add)) {
        if (!$exists) {
            $sql = "INSERT INTO `profile` (`cid`,`f_name`,`m_name`,`l_name`, `email`, `add`) VALUES ('$cid','$f_name','$m_name','$l_name', '$email','$add')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
                // Set a session variable to indicate the success message was shown
                $_SESSION['showAlert'] = true;
            } else {
                $showError = "Something went wrong: " . mysqli_error($conn);
            }
        } else {
            $showError = "Profile already exists";
        }
    } else {
        $showError = "All fields are required";
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

    <title>Profile</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 115vh;
        }
    </style>
</head>

<body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if ($showAlert) {
        echo ' <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>Success!</strong> Your profile is now created
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
    }
    if ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ' . $showError . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div> ';
    }
    ?>

    <div class="container">
        <div class="card" style="width: 30rem;">
            <div class="card-body">
                <h1 class="card-title text-center">Create your Profile</h1>
                <form action="/loginsystem/profile.php" method="post">
                    <div class="form-group">
                        <label for="cid">Customer ID</label>
                        <input type="integer" class="form-control" id="cid" name="cid" aria-describedby="emailHelp" value="<?php echo $_SESSION['cid']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="f_name">First name</label>
                        <input type="text" class="form-control" id="f_name" name="f_name" aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="m_name">Middle name</label>
                        <input type="text" class="form-control" id="m_name" name="m_name" aria-describedby="emailHelp">
                    </div>

                    <div class="form-group">
                        <label for="l_name">Last name</label>
                        <input type="text" class="form-control" id="l_name" name="l_name" aria-describedby="emailHelp">
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

                    <button type="submit" class="btn btn-primary">Create Profile</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        // Redirect to wel.php after 3 seconds if the success message is shown
        <?php if ($showAlert) { ?>
            setTimeout(function() {
                window.location.href = 'wel.php';
            }, 3000); // 3 seconds
        <?php } ?>
    </script>
</body>

</html>
