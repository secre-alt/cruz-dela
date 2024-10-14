<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('db_con.php'); // Include your database connection file

if(isset($_GET['token'])) {
    $token = $_GET['token'];

    // Prepare and execute the SELECT query
    $verify_query = $con->prepare("SELECT verify_token, verify_status FROM users WHERE verify_token=? LIMIT 1");
    $verify_query->bind_param('s', $token);
    $verify_query->execute();
    $verify_query_result = $verify_query->get_result();

    if (!$verify_query_result) {
        // If there is an error in the query
        $_SESSION['status'] = 'Error in verification process. Please try again later.';
        header("Location: login.php");
        exit(0);
    }

    if ($verify_query_result->num_rows > 0) {
        $row = $verify_query_result->fetch_assoc();

        if($row['verify_status'] == "0") {
            $clicked_token = $row['verify_token'];

            // Prepare and execute the UPDATE query
            $update_query = $con->prepare("UPDATE users SET verify_status='1' WHERE verify_token=? LIMIT 1");
            $update_query->bind_param('s', $clicked_token);
            $update_query_run = $update_query->execute();

            if ($update_query_run) {
                $_SESSION['status'] = 'Your account has been verified successfully. You can now log in.';
                header("Location: login.php");
                exit(0);
            } else {
                $_SESSION['status'] = 'Oops! Verification failed. Please try again.';
                header("Location: login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = 'Your email has already been verified. Please log in!';
            header("Location: login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = 'This token does not exist!';
        header("Location: login.php");
        exit(0);
    }
} else {
    $_SESSION['status'] = 'Invalid access. Not allowed!';
    header("Location: login.php");
    exit(0);
}
?>
