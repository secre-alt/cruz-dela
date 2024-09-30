<?php
session_start();
include('db_con.php'); // Include your database connection file

if (isset($_GET['token'])) {
    $verify_token = $_GET['token'];

    // Prepare a statement to select the user with the given verify token
    $stmt = $con->prepare("SELECT verify_token, email_verified FROM users WHERE verify_token = ? LIMIT 1");
    $stmt->bind_param('s', $verify_token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user data
        $row = $result->fetch_assoc();

        if ($row['email_verified'] == 0) {
            // Update the email_verified status to 1
            $stmt = $con->prepare("UPDATE users SET email_verified = 1 WHERE verify_token = ?");
            $stmt->bind_param('s', $verify_token);
            $update_run = $stmt->execute();

            if ($update_run) {
                $_SESSION['status'] = "Your email has been verified successfully!";
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['status'] = "Verification failed. Please try again.";
                header("Location: register.php");
                exit();
            }
        } else {
            $_SESSION['status'] = "Your email is already verified!";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "Invalid token.";
        header("Location: register.php");
        exit();
    }
} else {
    $_SESSION['status'] = "No verification token provided.";
    header("Location: register.php");
    exit();
}
?>
