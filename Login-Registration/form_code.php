<?php
session_start();
include('db_con.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Disable verbose debug output for production
        $mail->isSMTP();                                         
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                
        $mail->Username   = getenv('SMTP_USERNAME');              // Use environment variables for credentials
        $mail->Password   = getenv('SMTP_PASSWORD');             
        $mail->SMTPSecure = "ssl";                                
        $mail->Port       = 465;                                 

        //Recipients
        $mail->setFrom(getenv('SMTP_USERNAME'), 'Mailer');
        $mail->addAddress($email, $name);     // Send email to the registered user

        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Email verification from secre-alt';
        $mail_template = "
                <h1>You have Registered with Secre-alt</h1>
                <h5>Verify your Email address to login with the link below:</h5>
                <br><a href='http://localhost/Dela_Cruz/Login-Registration/verify_email.php?token=$verify_token'>Click here to verify</a>
        ";
        $mail->Body    = $mail_template;
        $mail->AltBody = 'Verify your email address to complete the registration.';

        $mail->send();
        echo 'Verification email has been sent';
    } catch (Exception $e) {
        error_log("Mail Error: {$mail->ErrorInfo}");
        echo 'Failed to send email verification.';
    }
}

if (isset($_POST['register_btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone']; 
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $verify_token = md5(rand()); 

    
    //Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT email FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['status'] = "Email ID already exists!";
        header("Location: register.php");
    } else {
        $stmt = $con->prepare("INSERT INTO users (name, phone, email, password, verify_token) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $name, $phone, $email, $password, $verify_token);
        $query_run = $stmt->execute();

        if ($query_run) {
            sendemail_verify($name, $email, $verify_token);
            $_SESSION['status'] = "Registration Successful! Please verify your Email Address.";
            header("Location: register.php");
        } else {
            error_log("SQL Error: " . $stmt->error);
            $_SESSION['status'] = "Registration Failed. Please try again.";
            header("Location: register.php");
        }
     }
     $stmt->close();
} 
?>
