<?php 
session_start(); // Start the session

$page_title = "Dashboard";
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-5 bg-light"> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3><i class="bi bi-person-circle"></i> User Dashboard</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h5>
                                    <?php 
                                    if (isset($_SESSION['username'])) {
                                        echo "Welcome, <strong>{$_SESSION['username']}</strong>!";
                                    } else {
                                        echo "Welcome, Guest!";
                                    }
                                    ?>
                                </h5>
                                <p class="mt-3">You have successfully logged in. Below you can access your profile information and settings.</p>
                                <hr>
                                <div class="row mt-4">
                                    <!-- Card 1 -->
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-primary shadow-sm">
                                            <div class="card-body text-center">
                                                <i class="bi bi-person-badge display-4 text-primary"></i>
                                                <h5 class="mt-3">Profile</h5>
                                                <p>View and update your personal information.</p>
                                                <a href="profile.php" class="btn btn-outline-primary btn-sm">Go to Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card 2 -->
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-success shadow-sm">
                                            <div class="card-body text-center">
                                                <i class="bi bi-gear display-4 text-success"></i>
                                                <h5 class="mt-3">Settings</h5>
                                                <p>Manage your account settings and preferences.</p>
                                                <a href="settings.php" class="btn btn-outline-success btn-sm">Go to Settings</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- /.row -->
                            </div>
                        </div> <!-- /.row -->
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col-md-8 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div> <!-- /.py-5 -->

<?php include('includes/footer.php'); ?>
