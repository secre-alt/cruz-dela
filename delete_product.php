<?php  
include('includes/header.php');
include('db.php');
include('includes/alert.php');

// Check if there's a status message in the session
if (isset($_SESSION['status']) && isset($_SESSION['status_icon'])) {
    // Show SweetAlert based on session data
    sweetAlert($_SESSION['status'], $_SESSION['status'], $_SESSION['status_icon']);
    
    // Clear the session status after displaying the alert
    unset($_SESSION['status']);
    unset($_SESSION['status_icon']);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = intval($_GET['id']); // Ensure the ID is an integer

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    // Execute the statement and handle the result
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $_SESSION['status'] = "Product successfully deleted!";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status'] = "Product not found or already deleted.";
            $_SESSION['status_icon'] = "warning";
        }
    } else {
        $_SESSION['status'] = "Error deleting the product. Please try again.";
        $_SESSION['status_icon'] = "error";
    }

    $stmt->close(); // Close the statement
} else {
    $_SESSION['status'] = "Invalid product ID.";
    $_SESSION['status_icon'] = "error";
}

// Redirect to the dashboard
header("Location: dashboard.php");
exit();
?>

<?php include('includes/footer.php'); ?>
