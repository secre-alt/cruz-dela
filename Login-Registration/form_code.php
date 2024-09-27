<?php
session_start();
include('db_con.php'); 

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token) {
    
    //Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'triannesano@gmail.com';                //SMTP username
        $mail->Password   = 'wilp oevw kqok nysn';                  //SMTP password
        $mail->SMTPSecure = "ssl";                                  //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to

        //Recipients
        $mail->setFrom('triannesano@gmail.com', 'Mailer');
        $mail->addAddress($email, $name);                           //Add a recipient

        //Content
        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = 'Email verification from secre-alt';
        $mail_template = "
            <h1>You have Registered with Secre-alt</h2>
            <h5>Verify your Email address to login with the link below</h5>
            <br></br>
            <a href='http://localhost/Dela_Cruz/Login-Registration/verify_email.php?token=$verify_token'>Click Me</a>
        ";
        $mail->Body    = $mail_template;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Verification email sent!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['register_btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone']; 
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $verify_token = md5(rand()); 

    // Send verification email
    sendemail_verify($name, $email, $verify_token);

    // Check if email already exists
    $check_email_query = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['status'] = "Email ID already exists!";
        header("Location: register.php");
    } else {
        // Insert user data into the database
        $query = "INSERT INTO users (name, phone, email, password, verify_token) 
                  VALUES ('$name', '$phone', '$email', '$password', '$verify_token')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $_SESSION['status'] = "Registration Successful! Please verify your Email Address.";
            header("Location: register.php");
        } else {
            $_SESSION['status'] = "Registration Failed. Please try again.";
            header("Location: register.php");
        }
    }
} 
?>