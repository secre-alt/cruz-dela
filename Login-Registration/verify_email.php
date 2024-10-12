<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('db_con.php'); // Include your database connection file

if(isset($_GET['token'])) {

    $token = $_GET['token'];

    // Debugging output: Check if token is received
    echo "Token from URL: " . htmlspecialchars($token) . "<br>";

    // Prepare and execute the SELECT query
    $verify_query = $con->prepare("SELECT verify_token, verify_status FROM users WHERE verify_token=? LIMIT 1");
    $verify_query->bind_param('s', $token);
    $verify_query->execute();
    $verify_query_result = $verify_query->get_result();

    if (!$verify_query_result) {
        echo "Error in SELECT query: " . mysqli_error($con);
        exit();
    }

    if ($verify_query_result->num_rows > 0) {
        $row = $verify_query_result->fetch_assoc();
        echo "Verification status from DB: " . $row['verify_status'] . "<br>";

        if($row['verify_status'] == "0") {
            $clicked_token = $row['verify_token'];

            // Debugging output: Check if we got the right token
            echo "Clicked Token: " . htmlspecialchars($clicked_token) . "<br>";

            // Prepare and execute the UPDATE query
            $update_query = $con->prepare("UPDATE users SET verify_status='1' WHERE verify_token=? LIMIT 1");
            $update_query->bind_param('s', $clicked_token);
            $update_query_run = $update_query->execute();

            if (!$update_query_run) {
                echo "Error in UPDATE query: " . mysqli_error($con);
                exit();
            }

            if ($update_query_run) {
                echo "Update successful!";
                $_SESSION['status'] = 'Your account has been verified successfully. You can now log in.';
                header("Location: login.php");
                exit(0);
            } else {
                $_SESSION['status'] = 'Verification Failed! Please try again';
                header("Location: login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = 'Email already verified. Please Login!';
            header("Location: login.php");
            exit(0);
        }
    } else {
        echo "No rows found with the token";
        $_SESSION['status'] = 'This token does not Exist!';
        header("Location: login.php");
        exit(0);
    }
} else {
    $_SESSION['status'] = 'Not Allowed!';
    header("Location: login.php");
    exit(0);
}
?>
