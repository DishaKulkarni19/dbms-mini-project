<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_create_admin.php'; // Include the file for database connection

    // Check if the connection is successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetching input values
    $aid = $_POST["aid"];
    $password = $_POST["password"];

    // SQL query to fetch user details
    $sql = "SELECT * FROM create_admin WHERE aid=? AND password=?";
    $stmt = mysqli_stmt_init($conn);

    // Prepare the statement
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind parameters to the placeholders
        mysqli_stmt_bind_param($stmt, "ss", $aid, $password);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Check the number of rows in the result
        if (mysqli_num_rows($result) == 1) {
            // Valid user, set session variables and redirect
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['aid'] = $aid;
            $login = true;
            header("location: user_info.php");
            exit();
        } else {
            // Invalid credentials
            $showError = "Invalid Credentials";
        }
    } else {
        // SQL query preparation failed
        $showError = "SQL Error";
    }

    // Close statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Admin Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container my-4">
        <h1 class="text-center">Access Admin Account</h1>
        <?php
        if ($login) {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You are logged in
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
        }
        if ($showError) {
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> ' . $showError . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> ';
        }
        ?>
        <form action="/loginsystem/access_admin.php" method="post">
            <div class="form-group">
                <label for="aid">Admin ID</label>
                <input type="text" class="form-control" id="aid" name="aid" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Access</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
