<?php
session_start(); // Start the session

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: login.php");
    exit;
}

// Regenerate session ID to prevent session fixation attacks
session_regenerate_id(true);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Welcome - <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest' ?></title>
    <style>
        .sidebar {
            height: calc(100vh - 120px); /* Adjusted height to fit below the company name */
            width: 250px;
            position: fixed;
            top: 100px; /* Added top margin for the company name */
            left: 0;
            background-color: #aed9e0; /* Pastel blue background color */
            padding-top: 70px;
        }

        .content {
            margin-left: 220px;
            padding: 201px;
        }

        .option {
            margin-bottom: 70px; /* Increased margin for more vertical space */
        }

        .company-name {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100px; /* Increased height for a broader header */
            background-color: #001F3F; /* Navy blue background color */
            color: white;
            font-size: 38px; /* Increased font size */
            line-height: 100px; /* Centering the text vertically */
            text-align: center;
        }

        .alert-message {
            margin-top: 80px; /* Adjusted margin to position below the header */
        }
    </style>
</head>
<body>
    <div class="company-name">
        TaRang Electric Company <!-- Change this to your company name -->
    </div>

    <div class="sidebar">
        <div class="option">
            <a href="profile.php" class="btn btn-dark btn-block">User Profile</a> <!-- Link to profile.php -->
        </div>
        <div class="option">
            <a href="bill.php" class="btn btn-dark btn-block">Bill</a> <!-- Link to bill.php -->
        </div>
        <!-- <div class="option">
            <a href="#" class="btn btn-dark btn-block">Payment History</a>
        </div> -->
        <div class="option">
            <a href="/loginsystem/logout.php" class="btn btn-dark btn-block">Logout</a>
        </div>
    </div>

    <div class="content">
        <h2>Welcome - <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest' ?></h2>
        <div class="alert alert-success alert-message" role="alert">
            <p>Hey, how are you doing? Welcome to your electricity bill management system. You are logged in as <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest' ?>.</p>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
