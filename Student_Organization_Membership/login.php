<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>

<?php
$page_title = "Login to Your Organization";
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-5 bg-light"> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
              
                <?php include('includes/alert_login.php'); ?>
  
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Login to Your Organization</h5> 
                    </div>
                    <div class="card-body">
                        <form action="process_login.php" method="POST">
                            
                            <!-- Email Address -->
                            <div class="form-group mb-3 position-relative"> 
                                <label for="email">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required aria-label="Email Address">
                                </div>
                            </div>
                            
                            <!-- Password -->
                            <div class="form-group mb-3 position-relative"> 
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required aria-label="Password">
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" name="login_btn" class="btn btn-dark w-100">Login</button>
                            </div>

                            <!-- Forgot Password Link -->
                            <div class="form-group text-center mt-2">
                                <a href="forgot_password.php">Forgot Password?</a>
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



<?php include('includes/footer.php'); ?>
