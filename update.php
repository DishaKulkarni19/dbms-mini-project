<?php
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_user_info.php'; // Include the file for database connection

    // Retrieve form data
    $cid = $_POST["cid"];
    $bill_no = $_POST["bill_no"];
    $name = $_POST["name"];
    $kw = $_POST["kw"];

    // Prepare and execute SQL query
    $sql = "UPDATE `user_info` SET `bill_no`='$bill_no', `name`='$name', `kw`='$kw' WHERE `cid`='$cid'";
    $result = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if ($result) {
        $showAlert = true;
    } else {
        $showError = "Something went wrong: " . mysqli_error($conn);
    }
} else {
    // If not POST request, retrieve existing user info to pre-fill the form
    if (isset($_GET['cid'])) {
        include 'partials/_user_info.php'; // Include the file for database connection
        $cid = $_GET['cid'];

        // Retrieve existing user info
        $sql = "SELECT * FROM `user_info` WHERE `cid`='$cid'";
        $result = mysqli_query($conn, $sql);

        // Check if the user exists
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $bill_no = $row['bill_no'];
            $name = $row['name'];
            $kw = $row['kw'];
        } else {
            $showError = "User not found!";
        }
    } else {
        $showError = "Customer ID not provided!";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update User Info</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <?php require 'partials/_nav.php' ?>
    <?php
    // Show success or error message if set
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> User info updated successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
    if($showError){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $showError .'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
    ?>

    <div class="container my-4">
        <h1 class="text-center">Update User Info</h1>
        <form action="update.php" method="post">
            <div class="form-group">
                <label for="cid">Customer ID</label>
                <input type="text" class="form-control" id="cid" name="cid" value="<?php echo $cid; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="bill_no">Bill Number</label>
                <input type="text" class="form-control" id="bill_no" name="bill_no" value="<?php echo $bill_no; ?>" required>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>

            <div class="form-group">
                <label for="kw">Kilo-Watt</label>
                <input type="text" class="form-control" id="kw" name="kw" value="<?php echo $kw; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Update User Info</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>