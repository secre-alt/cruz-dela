<?php
session_start();

$page_title = "Add Member";
include('includes/header.php');
include('includes/navbar.php');
include('includes/alert.php');
include('db_con.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    $full_name = $con->real_escape_string($_POST['full_name']);
    $course = $con->real_escape_string($_POST['course']);
    $year_level = intval($_POST['year_level']);
    $position = $con->real_escape_string($_POST['position']);
    $email = $con->real_escape_string($_POST['email']);
    $phone = $con->real_escape_string($_POST['phone']);

    
    $check_email = "SELECT * FROM members WHERE email='$email'";
    $result = $con->query($check_email);

    if ($result->num_rows > 0) {
        showAlert('error', 'Error', 'Email already exists. Try another one.');
    } else {
        
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
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="mb-0">Add New Member</h4>
                </div>
                <div class="card-body">
                    <form action="add_member.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Full Name" required>
                            <label for="full_name"> <i class="bi bi-person me-2"></i>Full Name</label>
                        </div>

                         <div class="form-floating mb-3">
                            <input type="text" name="course" id="course" class="form-control" placeholder="Course" required>
                            <label for="course"> <i class="bi bi-book me-2"></i>Course</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select name="year_level" id="year_level" class="form-select" required>
                                <option value="" disabled selected></option>
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>
                            <label for="year_level"><i class="bi bi-calendar me-2"></i>Year Level</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="position" id="position" class="form-control" placeholder="Position" required>
                            <label for="position"> <i class="bi bi-briefcase me-2"></i>Position</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" required>
                            <label for="email"> <i class="bi bi-envelope me-2"></i>Email</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" required>
                            <label for="phone"> <i class="bi bi-telephone me-2"></i>Phone Number</label>
                        </div>

                        <button type="submit" class="btn btn-dark">Add Member</button>

                       <div class="d-flex justify-content-between">
                        <a href="dashboard.php" class="bnt btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i>Back</a>
                       </div>
             
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    
    input.form-control:focus, select.form-select:focus {
    border-color: #6c757d; /* Dark gray border */
    box-shadow: 0 0 8px rgba(108, 117, 125, 0.5); /* Glow effect */
    outline: none;
    transition: box-shadow 0.3s ease-in-out, border-color 0.3s ease-in-out;
    }

    label {
        font-weight: 500;
        color: #6c757d;
    }

    button.btn {
        transition: background-color 0.3s ease-in-out, transform 0.2s ease-in-out;
    }

    button.btn:hover {
        background-color: #343a40; /* Darker hover color */
        transform: scale(1.02);
    }

</style>

<?php include('includes/footer.php'); ?>
