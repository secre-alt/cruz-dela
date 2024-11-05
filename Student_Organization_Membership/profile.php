<?php 
session_start();
include('db_con.php');

// Check if the user is authenticated
if (!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Please login to access the profile.";
    header('Location: login.php');
    exit(0);
}

if (isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    $user_email = $_SESSION['auth_user']['email'];

    // Update the user information
    $query = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE email='$user_email'";
    if (mysqli_query($con, $query)) {
        $_SESSION['auth_user']['username'] = $name;
        $_SESSION['auth_user']['email'] = $email;
        $_SESSION['auth_user']['phone'] = $phone;
        $_SESSION['status'] = "Profile updated successfully!";
    } else {
        $_SESSION['status'] = "Failed to update profile.";
    }
    header('Location: profile.php');
    exit(0);
}

// Fetch user information
$user_email = $_SESSION['auth_user']['email'];
$query = "SELECT * FROM users WHERE email='$user_email' LIMIT 1";
$result = mysqli_query($con, $query);
$user_data = mysqli_fetch_assoc($result);
?>

<?php
$page_title = "Profile";
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3> <i class="bi bi-person-fill"></i> Update Profile</h3>
                </div>
                <div class="card-body">
                    <form action="profile.php" method="POST">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <input type="text" name="name" class="form-control" value="<?php echo $user_data['name']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input type="email" name="email" class="form-control" value="<?php echo $user_data['email']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="phone" class="form-label">Phone</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                <input type="text" name="phone" class="form-control" value="<?php echo $user_data['phone']; ?>">
                            </div>
                        </div>
                        <button type="submit" name="update_profile" class="btn btn-primary w-100">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
