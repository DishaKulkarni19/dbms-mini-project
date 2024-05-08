<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Bill Information</title>
</head>
<body>
    <?php require 'partials/_nav.php' ?>

    <div class="container my-4">
        <h1 class="text-center">Bill Information</h1>

        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Customer Number</th>
                            <th>Bill Number</th>
                            <th>Name</th>
                            <th>Bill Due Date</th>
                            <th>KW</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include database connection
                        include 'partials/_user_info.php';
                        include 'partials/_dbconnect.php';
                        include 'partials/_profile.php';
                        // Start the session to access logged-in user info
                        session_start();
                        
                        // Check if the user is logged in
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                            // Get the logged-in user's username
                            $username = $_SESSION['username'];
                            
                            // Fetch user's customer ID from the signup table in usersdb
                            $sql_signup = "SELECT cid FROM users.users WHERE username = '$username'";
                            $result_signup = mysqli_query($conn, $sql_signup);
                            
                            // Check if the query executed successfully
                            if($result_signup) {
                                // Check if any rows were returned
                                if(mysqli_num_rows($result_signup) > 0) {
                                    $row_signup = mysqli_fetch_assoc($result_signup);
                                    $cid = $row_signup['cid'];
                                    
                                    // Fetch user info for the given customer ID from the user_info table in billdb
                                    $sql_user_info = "SELECT * FROM `user_info`.`user_info` WHERE `cid` = '$cid'";
                                    $result_user_info = mysqli_query($conn, $sql_user_info);
                                    
                                    // Check if the query executed successfully
                                    if($result_user_info) {
                                        // Check if there is any result
                                        if (mysqli_num_rows($result_user_info) > 0) {
                                            while ($row_user_info = mysqli_fetch_assoc($result_user_info)) {
                                                echo '<tr>';
                                                echo '<td>' . $row_user_info['cid'] . '</td>';
                                                echo '<td>' . $row_user_info['bill_no'] . '</td>';
                                                echo '<td>' . $row_user_info['name'] . '</td>';
                                                echo '<td>' . $row_user_info['date'] . '</td>';
                                                echo '<td>' . $row_user_info['kw'] . '</td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="5">No user info found for this customer ID.</td></tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5">Error fetching user info: ' . mysqli_error($conn) . '</td></tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="5">Customer ID not found for this user.</td></tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5">Error fetching customer ID: ' . mysqli_error($conn) . '</td></tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">User is not logged in.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
