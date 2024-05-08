<?php
// Include database connection
include 'partials/_user_info.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the customer ID is set and not empty
    if (isset($_POST["cid"]) && !empty($_POST["cid"])) {
        // Sanitize the customer ID to prevent SQL injection
        $cid = mysqli_real_escape_string($conn, $_POST["cid"]);

        // Prepare a DELETE statement
        $sql = "DELETE FROM `user_info` WHERE `cid` = '$cid'";

        // Execute the DELETE statement
        if (mysqli_query($conn, $sql)) {
            // Redirect back to the page after successful deletion
            header("Location: show.php");
            exit; // Make sure to exit after redirection
        } else {
            // If an error occurs, display an error message
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        // If the customer ID is not set or empty, display an error message
        echo "Customer ID is not valid.";
    }
} else {
    // If the form is not submitted, redirect to the original page
    header("Location: show.php");
    exit; // Make sure to exit after redirection
}
?>
