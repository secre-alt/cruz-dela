<?php
session_start();
include("db_con.php");

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $con-> prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $email,);  
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['email_verified'] == 1) { 

            if (password_verify($password, $row['password'])) { 
                $_SESSION['auth'] = true;
                $_SESSION['auth_user'] = [
                    'id'=> $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                ];

                $_SESSION['status'] = "Logged in successfully!";
                header("Location: dashboard.php");
                exit();

            } else {
                $_SESSION['status'] = "Invalid password.";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['status'] =   "Please verify your Email address to Login.";
            header("Location: login.php");
        }
    } else {
        $_SESSION['status'] = "Email not registered";
        header("Location: login.php");
        exit();
    }
}
?>