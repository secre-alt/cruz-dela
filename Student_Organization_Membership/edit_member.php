<?php
include('includes/header.php'); 
include('db_con.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $result = $con->query("SELECT * FROM members WHERE id = $id");
    $member = $result->fetch_assoc();

    if (!$member) {
        showAlert('error', 'Not Found', 'Member not Found.');
        echo "<script>setTimeout(function(){ window.location.href='dashboard.php'; }, 2000);</script>";
        exit();
    }
} else {
    echo "<script>window.location.href='dashboard.php';</script>";
    exit();    
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $full_name = $con->real_escape_string($_POST['full_name']);
        $course = $con->real_escape_string($_POST['course']);
        $year_level = intval($_POST['year_level']);
        $position = $con->real_escape_string($_POST['position']);
        $email = $con->real_escape_string($_POST['email']);
        $phone = $con->real_escape_string($_POST['phone']);
    
        $sql = "UPDATE members SET full_name='$full_name', course='$course', year_level=$year_level, position='$position', email='$email', phone='$phone' WHERE id=$id";
    
        if ($con->query($sql) === TRUE) {
            showAlert('success', 'Updated', 'Member updated successfully!');
            echo "<script>setTimeout(function(){ window.location.href='dashboard.php'; }, 2000);</script>";
        } else {
            showAlert('error', 'Error', 'Failed to update member. Please try again.');
        }
    }
    ?>


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="mb-0">Update Member</h4>
                </div>
                <div class="card-body">
                    <form action="update_member.php" method="POST">

                        <div class="form-floating mb-3">
                            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Full Name" 
                            value="<?php echo htmlspecialchars($member['full_name'])?>" required>
                            <label for="full_name"> <i class="bi bi-person me-2"></i>Full Name</label>
                        </div>

                         <div class="form-floating mb-3">
                            <input type="text" name="course" id="course" class="form-control" placeholder="Course" 
                            value="<?php echo htmlspecialchars($member['course'])?>"required>
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
                            <input type="text" name="position" id="position" class="form-control" placeholder="Position" 
                            value="<?php echo htmlspecialchars($member['position'])?>" required>
                            <label for="position"> <i class="bi bi-briefcase me-2"></i>Position</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" 
                            value="<?php echo htmlspecialchars($member['email'])?>" required>
                            <label for="email"> <i class="bi bi-envelope me-2"></i>Email</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number" 
                            value="<?php echo htmlspecialchars($member['phone'])?>" required>
                            <label for="phone"> <i class="bi bi-telephone me-2"></i>Phone Number</label>
                        </div>

                        <button type="submit" name="update_member" class="btn btn-dark">Update Member</button>

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

<?php include('includes/footer.php'); ?>