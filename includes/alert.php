<?php 
if (isset($_SESSION['status'])) {
    $statusMessage = $_SESSION['status'];
    $alertType = 'info'; // Default alert type for SweetAlert

    // Determine the SweetAlert icon type based on the status message
    if (stripos($statusMessage, 'successfully') !== false) {
        $alertType = 'success';
    } elseif (stripos($statusMessage, 'Failed') !== false) {
        $alertType = 'error';
    } elseif (stripos($statusMessage, 'already verified') !== false) {
        $alertType = 'warning';
    }

    // Generate the SweetAlert JavaScript code
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "' . htmlspecialchars($alertType, ENT_QUOTES, 'UTF-8') . '",
                title: "Alert",
                text: "' . htmlspecialchars($statusMessage, ENT_QUOTES, 'UTF-8') . '",
                confirmButtonColor: "#ff69b4" // Optional: Use a custom pink button color
            });
        });
    </script>';

    unset($_SESSION['status']);
}


?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('db.php');

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

// CSRF Token Validation and Product Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        // Sanitize and retrieve form inputs
        $product_name = $conn->real_escape_string($_POST['name']);
        $category = $conn->real_escape_string($_POST['category']);
        $stock_quantity = intval($_POST['stock_quantity']);

        // Check for duplicate product
        $check_product = "SELECT * FROM products WHERE name='$product_name' AND category='$category'";
        $result = $conn->query($check_product);

        if ($result->num_rows > 0) {
            showAlert('error', 'Duplicate Entry', 'Product with this name and category already exists. Please try another.');
        } else {
            // Insert new product into the database
            $sql = "INSERT INTO products (name, category, stock_quantity) 
                    VALUES ('$product_name', '$category', $stock_quantity)";

            if ($conn->query($sql) === TRUE) {
                showAlert('success', 'Product Added', 'New product added successfully!', 'warehouse_dashboard.php');
            } else {
                showAlert('error', 'Error', 'Failed to add product. Please try again.');
            }
        }
    } else {
        showAlert('error', 'Invalid Request', 'CSRF token validation failed.');
    }
}




?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!-- includes/alert.php -->
<?php 
if (isset($_SESSION['status'])) { 
    $status = $_SESSION['status'];
    $statusClass = strpos($status, 'Success') !== false ? 'alert-success' : (strpos($status, 'exists') !== false ? 'alert-warning' : 'alert-danger');
    $statusIcon = strpos($status, 'Success') !== false ? 'fas fa-check-circle' : (strpos($status, 'exists') !== false ? 'fas fa-exclamation-circle' : 'fas fa-times-circle');
    echo "<div class='alert $statusClass alert-dismissible fade show' role='alert'>
            <i class='$statusIcon'></i> $status
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    unset($_SESSION["status"]); // Clear status after displaying
}
?>

<?php
if (isset($_SESSION['status'])) {
    $status_message = $_SESSION['status']; // Store the session status in a variable
    $icon = 'info'; // Default icon
    $title = 'Notice!'; // Default title
    $button_text = 'OK'; // Default button text

    // Check for success, warning, or error messages
    if (strpos($status_message, 'verified success') !== false) {
        $icon = 'success';
        $title = 'Success!';
      
    } elseif (strpos($status_message, 'Success') !== false || strpos($status_message, 'verified successfully') !== false) {
        $icon = 'success';
        $title = 'Success!';
        $button_text = 'Let\'s Go!';
    } elseif (strpos($status_message, 'hasn\'t been verified') !== false) {
        $icon = 'warning';
        $title = 'Verify Your Email';
        $button_text = 'Check Inbox';
    } elseif (strpos($status_message, 'incorrect') !== false || strpos($status_message, 'not registered') !== false) {
        $icon = 'error';
        $title = 'Login Failed';
        $button_text = 'Try Again';
    } elseif (strpos($status_message, 'All fields are required') !== false) {
        $icon = 'warning';
        $title = 'Incomplete Fields';
        $button_text = 'Fill Details';
    } elseif (strpos($status_message, 'already been verified') !== false || strpos($status_message, 'Please Login') !== false) {
        $icon = 'info';
        $title = 'Please Login!';
        $button_text = 'Login';
    } elseif (strpos($status_message, 'kung ako nalang diay?') !== false) {
        $icon = 'success'; // For logout success
        $title = 'LODS!';
        $button_text = 'Please nani';
    }

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '$icon',
                title: '$title',
                html: '" . addslashes($status_message) . "',
                confirmButtonColor: '#3085d6',
                confirmButtonText: '$button_text',
                background: '#f0f0f0', // Light background for better contrast
                customClass: {
                    popup: 'swal-custom-popup', // Add custom class for styling
                    title: 'swal-custom-title',
                    content: 'swal-custom-content',
                    confirmButton: 'swal-custom-button'
                }
            });
        });
    </script>";

    unset($_SESSION['status']); // Clear status after displaying
}
?>

<script>
  Swal.fire({
    title: 'Deleted!',
    text: 'Your file has been deleted.',
    icon: 'success',
    confirmButtonText: 'OK'
  });
</script>

<?php
function sweetAlert($title, $text, $icon = 'success', $confirmButtonText = 'OK') {
    // Check if the SweetAlert script is already included
    static $sweetAlertIncluded = false;

    // Include SweetAlert script only once
    if (!$sweetAlertIncluded) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        $sweetAlertIncluded = true;
    }

    // Display the SweetAlert popup
    echo "<script>
        Swal.fire({
            title: '$title',
            text: '$text',
            icon: '$icon',
            confirmButtonText: '$confirmButtonText'
        });
    </script>";
}

function sweetAlertError($text, $title = 'Error') {
    sweetAlert($title, $text, 'error');
}

function sweetAlertSuccess($text, $title = 'Success') {
    sweetAlert($title, $text, 'success');
}
?>
