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
       <div class="col-lg-10">
           <div class="card shadow-lg border-0 rounded-lg">
               <div class="card-header bg-dark text-white text-center rounded-top">
                   <h4 class="mb-0"><i class="bi bi-person-fill"></i>Add New Member</h4>
               </div>
               <div class="card-body">
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
                           <label for="yearLevel">Year Level</label>
                           <select class="form-control" id="yearLevel" name="year_level" required>
                               <option value="" disabled selected>Select Year</option>
                               <option value="1st Year">1st Year</option>
                               <option value="2nd Year">2nd Year</option>
                               <option value="3rd Year">3rd Year</option>
                               <option value="4th Year">4th Year</option>
                           </select>
                       </div>
                       <div class="mb-3">
                           <label for="position" class="form-label">Position</label>
                           <input type="text" class="form-control" id="position" name="position" required>
                       </div>
                       <div class="mb-3">
                           <label for="email" class="form-label">Email</label>
                           <input type="email" class="form-control" id="email" name="email" required>
                       </div>
                       <div class="mb-3">
                           <label for="phone" class="form-label">Phone</label>
                           <input type="text" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" required>
                       </div>
                       <button type="submit" class="btn btn-dark">Add Member</button>
                       <a href="dashboard.php" class="btn btn-secondary">Back</a>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>

<?php include('includes/footer.php'); ?>
