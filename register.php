<?php 
session_start();
$page_title = "Registration Form";
include('includes/header.php');
include('includes/navbar.php');
?>


<div class="py-5 bg-light"> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
            
            <!-- Alert Messages -->
                <div class="alert <?php echo isset($_SESSION['status']) ? (strpos($_SESSION['status'], 'Success') !== false ? 'alert-success' : (strpos($_SESSION['status'], 'exists') !== false ? 'alert-warning' : 'alert-danger')) : ''; ?> alert-dismissible fade show" role="alert">
                    <?php 
                        if (isset($_SESSION['status'])) { 
                            if (strpos($_SESSION['status'], 'Success') !== false) {
                                echo "<i class='fas fa-check-circle'></i> " . $_SESSION['status'];
                            } elseif (strpos($_SESSION['status'], 'exists') !== false) {
                                echo "<i class='fas fa-exclamation-circle'></i> " . $_SESSION['status'];
                            } else {
                                echo "<i class='fas fa-times-circle'></i> " . $_SESSION['status'];
                            }
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            unset($_SESSION["status"]); // Clear status after displaying
                        }
                    ?>
                </div>
                <div class="card shadow-lg">
                    <div class="card-header custom-header text-white">
                        <h5 class="mb-0">Registration Form</h5> 
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <!-- Name -->
                            <div class="form-group mb-3 position-relative"> 
                                <label for="name">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                                </div>
                            </div>
                            
                            <!-- Phone Number -->
                            <div class="form-group mb-3 position-relative"> 
                                <label for="phone">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone number" pattern="[0-9]{10}" title="Enter a valid 10-digit phone number" required>
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
                                <button type="submit" name="register_btn" class="btn btn-primary w-100">Register</button> 
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
<style>

  /* Background with subtle gradient */
.py-5.bg-light {
    background: linear-gradient(to bottom right, #d0e7ff, #8db5e8);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 0;
}

/* Card header with bold style */
.custom-header {
    background-color: #003366; /* Dark navy blue */
    color: white;
    font-family: 'Roboto', sans-serif; /* Clean, modern font */
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
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Stronger shadow */
}

/* Input group styles */
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