<?php 
session_start(); 

// Check if the user is logged in, otherwise redirect to the login page
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit();
// }

$page_title = "Settings";
include('includes/header.php');
include('includes/navbar.php');
?>


<div class="py-5 bg-light"> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary bg-gradient text-white text-center">
                        <h3><i class="bi bi-gear"></i> Account Settings</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Here you can manage your account settings and preferences.</p>
                        <hr>

                        <!-- Example Settings Option 1: Change Password -->
                        <div class="mb-4">
                            <h5>Change Password</h5>
                            <p>Update your account password for better security.</p>
                            <a href="change-password.php" class="btn btn-outline-success btn-sm">Change Password</a>
                        </div>
                        
                        <!-- Example Settings Option 2: Update Email -->
                        <div class="mb-4">
                            <h5>Update Email</h5>
                            <p>Modify the email address associated with your account.</p>
                            <a href="update-email.php" class="btn btn-outline-success btn-sm">Update Email</a>
                        </div>
                        
                        <!-- Add more settings options as needed -->

                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col-md-8 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div> <!-- /.py-5 -->



<?php include('includes/footer.php'); ?>
