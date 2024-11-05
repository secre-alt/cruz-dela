<?php
include('includes/header.php'); 
include('includes/db_config.php');
include('includes/alert.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $result = $conn->query("SELECT * FROM members WHERE id = $id");
    $member = $result->fetch_assoc();

    if (!$member) {
        showAlert('error', 'Not Found', 'Member not Found.');
        echo "<script>setTimeout(function(){ window.location.href='index.php'; }, 2000);</script>";
        exit();
    }
} else {
    echo "<script>window.location.href='index.php';</script>";
    exit();    
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $full_name = $conn->real_escape_string($_POST['full_name']);
        $course = $conn->real_escape_string($_POST['course']);
        $year_level = intval($_POST['year_level']);
        $position = $conn->real_escape_string($_POST['position']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
    
        // Update SQL query
        $sql = "UPDATE members SET full_name='$full_name', course='$course', year_level=$year_level, position='$position', email='$email', phone='$phone' WHERE id=$id";
    
        if ($conn->query($sql) === TRUE) {
            showAlert('success', 'Updated', 'Member updated successfully!');
            echo "<script>setTimeout(function(){ window.location.href='index.php'; }, 2000);</script>";
        } else {
            showAlert('error', 'Error', 'Failed to update member. Please try again.');
        }
    }
    ?>



<div class="container mt-5">
    <h2>Edit member</h2>
    <form action="edit_member.php?id=<?php echo $id; ?>" method="POST">
        <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($member['full_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="course" class="form-label">Course</label>
            <input type="text" class="form-control" id="course" name="course" value="<?php echo htmlspecialchars($member['course']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="year_level" class="form-label">Year Level</label>
            <input type="number" class="form-control" id="year_level" name="year_level" value="<?php echo htmlspecialchars($member['year_level']); ?>" required min="1">
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" id="position" name="position" value="<?php echo htmlspecialchars($member['position']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($member['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($member['phone']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Member</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<?php include('includes/footer.php'); ?>