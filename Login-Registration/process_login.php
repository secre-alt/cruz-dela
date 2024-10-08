<?php 
include('db_con.php');

if (isset($_POST['login_btn'])) {

    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
       
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = $_POST['password']; // Don't escape password, it will be hashed

        // Use a prepared statement for security
        $stmt = $con->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row['password'])) {
                echo $row['verify_status'];
                // Set session variables if needed and redirect to dashboard
                $_SESSION['user'] = $row['email']; // example
                header("Location: dashboard.php");
                exit(0);
            } else {
                $_SESSION['status'] = "Invalid Email or Password";
                header("Location: login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Invalid Email or Password";
            header("Location: login.php");
            exit(0);
        }

    } else {
        $_SESSION['status'] = "All fields are mandatory";
        header("Location: login.php");
        exit(0);
    }
}
?>
