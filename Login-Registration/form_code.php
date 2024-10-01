<?php
session_start();
include('db_con.php'); 

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Disable verbose debug output
        $mail->isSMTP();                                         // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                   // Replace with your SMTP server
        $mail->SMTPAuth   = true;                               // Enable SMTP authentication
        $mail->Username   = 'triannesano@gmail.com';                  // Replace with your SMTP username
        $mail->Password   = 'wilp oevw kqok nysn';                            // Replace with your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        // Enable implicit TLS encryption
        $mail->Port       = 465;                                // TCP port to connect to

        // Recipients
        $mail->setFrom('triannesano@gmail.com', 'Secre-alt');        // Replace with your sender email
        $mail->addAddress($email, $name);                       // Add recipient
        $mail->addReplyTo('triannesano@gmail.com', 'Information');   // Optional reply-to

        // Content
        $mail->isHTML(true);                                    // Set email format to HTML
        $mail->Subject = 'Email Verification from Secre-alt';
        $mail_template = "
            <h1>You have Registered with Secre-alt</h1>
            <h5>Verify your Email address to log in using the link below:</h5>
            <br>
            <a href='http://localhost/Dela_Cruz/Login-Registration/$verify_token'>Click Me</a>
        ";
        $mail->Body    = $mail_template;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;  // Email sent successfully
    } catch (Exception $e) {
        return false; // Email failed to send
    }
}

if (isset($_POST['register_btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone']; 
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $verify_token = md5(rand()); // Generate a random verification token

    // Check if the email already exists
    $check_email_query = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['status'] = "Email ID already exists!";
        header("Location: register.php");
        exit();
    } else {
        // Insert the user data into the database
        $query = "INSERT INTO users (name, phone, email, password, verify_token) VALUES ('$name', '$phone', '$email', '$password', '$verify_token')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            // Call function to send verification email
            if (sendemail_verify($name, $email, $verify_token)) {
                $_SESSION['status'] = "Registration Successful! Verification email sent. Please check your inbox.";
            } else {
                $_SESSION['status'] = "Registration Successful, but the verification email failed to send.";
            }
            header("Location: register.php");
            exit();
        } else {
            $_SESSION['status'] = "Registration Failed. Please try again.";
            header("Location: register.php");
            exit();
        }
    }
}
?>
