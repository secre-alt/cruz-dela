<?php 
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_SESSION['authenticated'])) {
    
    $_SESSION['status'] = "Yippee! You’re already in your happy place!";
    header('Location: dashboard.php');
    exit(0);

}


$page_title = "Login Form";
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-5 bg-light"> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
               
                   <!-- Include alert messages -->
                <?php include('includes/alert.php'); ?>
  
                <div class="card shadow-lg">
                    <div class="card-header custom-header text-white">
                        <h5 class="mb-0">Login Form</h5> 
                    </div>
                    <div class="card-body">
                        <form action="logincode.php" method="POST">
                            
                            <!-- Email Address -->
                            <div class="form-group mb-3 position-relative"> 
                                <label for="email">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                            </div>
                            
                            <!-- Password -->
                            <div class="form-group mb-3 position-relative"> 
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" name="login_btn" class="btn btn-primary w-100">Login</button> 
                            </div>
                        
                            <div class="form-group text-center mt-3">
                                <p>Don't have an account yet? <a href="register.php">Sign Up</a></p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

 /* Background with a bold tone */
.py-5.bg-light {
    background: linear-gradient(to bottom right, #d0e7ff, #8db5e8);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 0;
}


.custom-header {
    background-color: #003366; 
    color: white;
    font-family: 'Roboto', sans-serif; 
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
    padding: 1rem 0;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}


.card-body {
    background-color: #f5f5f5; /* Light grey */
    border-radius: 0.5rem;
    padding: 2rem;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
}

/* Input group and form elements */
.input-group-text {
    background-color: #00509e; /* Blue tone */
    color: white;
    border: none;
}

.form-control {
    border: 2px solid #8db5e8; /* Light blue border */
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    font-family: 'Roboto', sans-serif;
    font-size: 1rem;
}

.form-control:focus {
    border-color: #00509e; /* Focused blue border */
    box-shadow: 0 0 10px rgba(0, 80, 158, 0.6);
}

/* Button styles */
.btn-primary {
    background-color: #003366; /* Navy blue */
    border: none;
    color: white;
    font-size: 1rem;
    font-weight: bold;
    padding: 0.75rem;
    border-radius: 0.5rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}


.btn-primary:hover {
    background-color: #00509e; /* Lighter blue on hover */
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(0, 80, 158, 0.6);
}

/* Link styles */
a {
    color: #00509e;
    font-weight: bold;
    transition: color 0.3s ease;
}

a:hover {
    color: #003366;
    text-decoration: underline;
}

/* Form labels */
.form-group label {
    color: #003366;
    font-family: 'Roboto', sans-serif;
    font-weight: bold;
}

/* Alerts: Success, Warning, and Error */
.alert-success {
    background-color: #d1e7dd;
    color: #0f5132;
    border-left: 5px solid #0f5132;
}

.alert-warning {
    background-color: #fff3cd;
    color: #664d03;
    border-left: 5px solid #664d03;
}

.alert-danger {
    background-color: #f8d7da;
    color: #842029;
    border-left: 5px solid #842029;
}

/* Header styles for the registration form */
h5.mb-0 {
    font-family: 'Roboto', sans-serif;
    font-size: 1.5rem;
    color: white;
}

/* Button focus styles */
.btn-primary:focus {
    outline: none;
    box-shadow: 0 0 10px rgba(0, 80, 158, 0.6);
}
</style>

<?php include('includes/footer.php'); ?>