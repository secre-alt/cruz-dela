<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
include('db_con.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token) {
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                
    $mail->Username   = "triannesano@gmail.com";              
    $mail->Password   = "wilp oevw kqok nysn";             
    $mail->SMTPSecure = "ssl";                                
    $mail->Port       = 465;                                  // Ensure this matches your SMTP server

    // Recipients
    $mail->setFrom('triannesano@gmail.com', $name);
    $mail->addAddress($email, $name);     // Send email to the registered user

    // Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Email verification from secre-alt';
    $email_template = "
        <h1>You have Registered with Secre-alt</h1>
        <h4>Verify your Email address to login with the link below:</h4>
        <br><a href='http://localhost/Dela_Cruz/Login-Registration/verify_email.php?token=$verify_token'>Click here to verify</a>
    ";
    $mail->Body    = $email_template;
    $mail->AltBody = 'Verify your email address to complete the registration.';
    
    try {
        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Email could not be sent
    }
}

if (isset($_POST['register_btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone']; 
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $verify_token = md5(rand()); 

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT email FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['status'] = "It looks like you already have an account with us. Try logging in or use a different email address.";
    } else {
        $stmt = $con->prepare("INSERT INTO users (name, phone, email, password, verify_token) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $name, $phone, $email, $password, $verify_token);
        $query_run = $stmt->execute();

        if ($query_run) {
            if (sendemail_verify($name, $email, $verify_token)) {
                $_SESSION['status'] = "🎉 Success! We’ve sent you a confirmation email. Please check your inbox to verify your account and get started.";
            } else {
                $_SESSION['status'] = "Oops! We couldn't send the verification email. Please try again.";
            }
        } else {
            error_log("SQL Error: " . $stmt->error);
            $_SESSION['status'] = "Oops! Something went wrong with your registration. Please try again, or contact support if the issue persists.";
        }
    }
    $stmt->close();
    header("Location: register.php");
    exit(0);
}
?>
