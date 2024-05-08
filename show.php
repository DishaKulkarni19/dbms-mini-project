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
        <h1 class="text-center">All customer Information</h1>

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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include database connection
                        include 'partials/_user_info.php';
                        
                        // Fetch all records from user_info table
                        $sql_user_info = "SELECT * FROM `user_info`";
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
                                    echo '<td>';
                                    // Update button
                                    echo '<form action="update.php" method="post" style="display: inline;">';
                                    echo '<input type="hidden" name="cid" value="' . $row_user_info['cid'] . '">';
                                    echo '<input type="hidden" name="bill_no" value="' . $row_user_info['bill_no'] . '">'; // Add hidden field for bill_no
                                    echo '<input type="hidden" name="name" value="' . $row_user_info['name'] . '">'; // Add hidden field for name
                                    echo '<input type="hidden" name="kw" value="' . $row_user_info['kw'] . '">'; // Add hidden field for kw
                                    echo '<button type="submit" class="btn btn-primary btn-sm mr-2" name="update">Update</button>'; // Added name attribute and update button class
                                    echo '</form>';
                                    // Delete button
                                    echo '<form action="delete.php" method="post" style="display: inline;">';
                                    echo '<input type="hidden" name="cid" value="' . $row_user_info['cid'] . '">';
                                    echo '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</button>'; // Confirmation before deleting
                                    echo '</form>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="6">No user info found.</td></tr>';
                            }
                        } else {
                            echo '<tr><td colspan="6">Error fetching user info: ' . mysqli_error($conn) . '</td></tr>';
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
