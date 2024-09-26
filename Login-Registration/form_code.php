<?php
session_start();
include('db_con.php'); 

if (isset($_POST['register_btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone']; 
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $verify_token = md5(rand()); 


    $check_email_query = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        
        $_SESSION['status'] = "Email ID already exists!";
        header("Location: register.php");
    } else {


        $query = "INSERT INTO users (name, phone, email, password, verify_token) VALUES ('$name', '$phone', '$email', '$password', '$verify_token')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {

          
            sendemail_verify($name, $email, $verify_token);

            $_SESSION['status'] = "Registration Successful! Please verify your email address.";
            header("Location: register.php");
        } else {
            $_SESSION['status'] = "Registration Failed. Please try again.";
            header("Location: register.php");
        }
    }
}
?>
