<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php session_start(); ?>
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
            $hashed_password = $row['password'];

            // Verify the password
            if (password_verify($password, $hashed_password)) {

                if ($row['verify_status'] == 1) {
                    
                    $_SESSION['authenticated'] = TRUE;
                    $_SESSION['auth_user'] = [
                        'organization_name' => $row['organization_name'],
                        'email' => $row['email'],
                    ];

                    // Success message for successful login
                    $_SESSION['status'] = "Welcome back, " . $row['organization_name'] . "! You have successfully logged in. Get ready to explore your dashboard.";
                    header("Location: dashboard.php");
                    exit(0);

                } else {
                    // Warning message for unverified email
                    $_SESSION['status'] = "Your email hasn't been verified yet. Please check your inbox for the verification link to activate your account.";
                    header("Location: login.php");
                    exit(0); 
                }
            } else {
                // Error message for incorrect password
                $_SESSION['status'] = "The password you entered is incorrect. Please try again or reset your password if you’ve forgotten it.";
                header("Location: login.php");
                exit(0);
            }
        } else {
            // New error message for unregistered email
            $_SESSION['status'] = "The email address you entered is not registered. Please check your email or sign up for a new account.";
            header("Location: login.php");
            exit(0);
        }

    } else {
        // Warning message for empty fields
        $_SESSION['status'] = "All fields are required. Please fill in both your email and password to continue.";
        header("Location: login.php");
        exit(0);
    }
}
?>