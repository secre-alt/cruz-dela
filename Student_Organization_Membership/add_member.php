<?php
session_start();

$page_title = "Add Member";
include('includes/header.php');
include('includes/navbar.php');
include('includes/alert.php');
include('db_con.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form inputs
    $full_name = $con->real_escape_string($_POST['full_name']);
    $course = $con->real_escape_string($_POST['course']);
    $year_level = intval($_POST['year_level']);
    $position = $con->real_escape_string($_POST['position']);
    $email = $con->real_escape_string($_POST['email']);
    $phone = $con->real_escape_string($_POST['phone']);

    // Check for duplicate email
    $check_email = "SELECT * FROM members WHERE email='$email'";
    $result = $con->query($check_email);

    if ($result->num_rows > 0) {
        showAlert('error', 'Error', 'Email already exists. Try another one.');
    } else {
        // Insert new member into the database
        $sql = "INSERT INTO members (full_name, course, year_level, position, email, phone) 
                VALUES ('$full_name', '$course', $year_level, '$position', '$email', '$phone')";

        if ($con->query($sql) === TRUE) {
            showAlert('success', 'Success', 'New member added successfully!');
            echo "<script>setTimeout(function(){ window.location.href='dashboard.php'; }, 2000);</script>";
        } else {
            showAlert('error', 'Error', 'Failed to add member. Please try again. ' . $con->error);
        }
    }
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
