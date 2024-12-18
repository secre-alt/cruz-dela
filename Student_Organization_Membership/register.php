<?php  
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$page_title = "Organization Membership Registration";
include('includes/header.php');
include('includes/navbar.php');
include('includes/alert.php'); 
?>

<div class="py-5 bg-light"> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Join an Organization</h5> 
                    </div>
                    <div class="card-body">
                        <form action="form_code.php" method="POST">
                            <!-- Organization Name -->
                            <div class="form-group mb-3 position-relative"> 
                                <label for="organization_name">Organization Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                    <input type="text" id="organization_name" name="organization_name" class="form-control" placeholder="Enter your organization's name" required>
                                </div>
                            </div>
                            
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
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" minlength="6" required>
                                </div>
                            </div>
                            
                            <!-- Confirm Password -->
                            <div class="form-group mb-3 position-relative"> 
                                <label for="confirm_password">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm your password" minlength="6" required>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" name="register_btn" class="btn btn-dark w-100">Join Organization</button> 
                            </div>

                            <div class="form-group text-center mt-3">
                                <p>Already have an account? <a href="login.php">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
