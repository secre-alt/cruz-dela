<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('db_con.php');

if (isset($_SESSION['status'])) {
    $status_message = $_SESSION['status'];
    $icon = 'info'; // Default icon
    $title = 'Notice!'; // Default title
    $button_text = 'OK'; // Default button text


    if (strpos($status_message, 'Success') !== false || strpos($status_message, 'verified success')) {
        $icon = 'success';
        $title = 'Salig!';
        $button_text = 'Let\'s Go!';
    } elseif (strpos($status_message, 'Oops') !== false || strpos($status_message, 'Incorrect password') !== false || 
    strpos($status_message, 'already have an account') !== false) {
        $icon = 'error';
        $title = 'You already have an account!';
        $button_text = 'Login';
    } elseif (stripos($status_message, 'You have successfully logged in') !== false || stripos($status_message, 'Welcome back, ') !== false) {
        $icon = 'success';
        $title = 'Welcome Back!';
        $button_text = 'Let\'s Go!';
    } elseif (stripos($status_message, 'Member updated successfully') !== false || stripos($status_message, 'updated') !== false) {
        $icon = 'success';
        $title = 'Updated!';
        $button_text = 'Let\'s Go!';
    } elseif (stripos($status_message, 'Member restored successfully!') !== false || stripos($status_message, '') !== false) {
        $icon = 'success';
        $title = 'Success!';
      
    } 
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '$icon',
                title: '$title',
                text: '" . addslashes($_SESSION['status']) . "',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        });
    </script>";

    unset($_SESSION['status']); // Clear status after displaying
}


function showAlert($icon, $title, $message, $redirect = null) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '$icon',
                title: '" . addslashes($title) . "',
                text: '" . addslashes($message) . "',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed && '$redirect') {
                    window.location.href = '$redirect';
                }
            });
        });
    </script>";
}

// CSRF Token Validation and Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
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
            showAlert('error', 'Duplicate Entry', 'Email already exists. Try another one.');
        } else {
            // Insert new member into the database
            $sql = "INSERT INTO members (full_name, course, year_level, position, email, phone) 
                    VALUES ('$full_name', '$course', $year_level, '$position', '$email', '$phone')";

            if ($con->query($sql) === TRUE) {
                showAlert('success', 'Member Added', 'New member added successfully!', 'dashboard.php');
            } else {
                showAlert('error', 'Error', 'Failed to add member. Please try again.');
            }
        }
    } else {
        showAlert('error', 'Invalid Request', 'CSRF token validation failed.');
    }
}

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<?php
// Fetch deleted members from the database
$deleted_sql = "SELECT * FROM members WHERE is_deleted = 1";
$deleted_result = $con->query($deleted_sql);

if ($deleted_result && $deleted_result->num_rows > 0) {
    echo "<h2>Deleted Members</h2>";
    while ($row = $deleted_result->fetch_assoc()) {
        echo "<div class='deleted-member'>
                <p>" . htmlspecialchars($row['full_name']) . "</p>
                <a href='#' class='btn btn-secondary btn-sm undo-btn' data-id='" . htmlspecialchars($row['id']) . "'>Undo</a>
              </div>";
    }
}
?>


