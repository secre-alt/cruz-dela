<?php  
$page_title = "Student Organization Membership Database";
include('includes/header.php');
include('includes/navbar.php');
?>

<!-- Hero Section -->
<div class="bg-light py-5 text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="display-4">Welcome to the Student Organization Portal</h1>
                <p class="lead">Your central hub for managing memberships, events, and resources for student organizations</p>
                <a href="register.php" class="btn btn-dark btn-lg">
                    <i class="fas fa-user-plus"></i> Join an Organization
                </a>
                <a href="login.php" class="btn btn-secondary btn-lg ms-2">
                    <i class="fas fa-sign-in-alt"></i> Member Login
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                <h5>Membership Management</h5>
                <p>Easily manage member information, roles, and access privileges to keep your organization organized.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-calendar-alt fa-3x text-success mb-3"></i>
                <h5>Event Registration</h5>
                <p>Stay informed and register for upcoming events, meetings, and activities hosted by various clubs.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-file-alt fa-3x text-info mb-3"></i>
                <h5>Access Resources</h5>
                <p>View important documents, announcements, and resources to stay connected with your organization.</p>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
