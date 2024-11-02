<?php
session_start();
include('db_config.php');
include('includes/alert.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize form data
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $course = $conn->real_escape_string($_POST['course']);
    $year_level = intval($_POST['year_level']);
    $position = $conn->real_escape_string($_POST['position']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);

    $sql = "INSERT INTO members (full_name, course, year_level, position, email, phone) 
            VALUES ('$full_name', '$course', $year_level, '$position', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        showAlert('success', 'Success', 'New member added successfully!');
        echo "<script>setTimeout(function(){ window.location.href='index.php'; }, 2000);</script>";
    } else {
        showAlert('error', 'Error', 'Failed to add member. Please try again.');
    }
}
?>

<?php include('includes/header.php'); ?>

<div class="container mt-5">
    <h2>Add New Members</h2>
    <form action="add_member.php" method="POST">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" required>
        </div>
        <div class="mb-3">
            <label for="course" class="form-label">Course</label>
            <input type="text" class="form-control" id="course" name="course" required>
        </div>
        <div class="mb-3">
            <label for="year_level" class="form-label">Year Level</label>
            <input type="text" class="form-control" id="year_level" name="year_level" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Member</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>
<?php include('includes/footer.php'); ?>