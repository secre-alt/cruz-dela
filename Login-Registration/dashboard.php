<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Please Login to access User Dashboard";
    header('Location: login.php');
    exit(0);
}

$page_title = "Dashboard";
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php include('includes/alert.php'); ?>
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center rounded-top">
                    <h3><i class="bi bi-person-circle"></i> User Dashboard</h3>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h5>
                            <?= isset($_SESSION['auth_user']['username']) 
                                ? "Welcome, <strong>{$_SESSION['auth_user']['username']}</strong>!"
                                : "Welcome, Guest!"; 
                            ?>
                        </h5>
                        <p class="text-muted">You have successfully logged in. Below you can access your profile information and settings.</p>
                    </div>

                    <!-- User Info -->
                    <div class="row text-center mb-3">
                        <div class="col-md-4">
                            <h5 class="text-muted">Username</h5>
                            <p><?= $_SESSION['auth_user']['username']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-muted">Phone No.</h5>
                            <p><?= $_SESSION['auth_user']['phone']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-muted">Email</h5>
                            <p><?= $_SESSION['auth_user']['email']; ?></p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Dashboard Options -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-person-badge display-4 text-primary"></i>
                                    <h5 class="mt-3">Profile</h5>
                                    <p class="text-muted">View and update your personal information.</p>
                                    <a href="profile.php" class="btn btn-outline-primary btn-sm rounded-pill">Go to Profile</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-gear display-4 text-success"></i>
                                    <h5 class="mt-3">Settings</h5>
                                    <p class="text-muted">Manage your account settings and preferences.</p>
                                    <a href="settings.php" class="btn btn-outline-success btn-sm rounded-pill">Go to Settings</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col-md-8 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->

<?php include('includes/footer.php'); ?>
