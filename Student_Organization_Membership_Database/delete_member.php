<?php
include('db_config.php');
include('includes/alert.php'); // Include SweetAlert function

// Check if the 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM members WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        showAlert('success', 'Deleted', 'Member deleted successfully!');
    } else {
        showAlert('error', 'Error', 'Failed to delete member. Please try again.');
    }
} else {
    showAlert('error', 'Error', 'Invalid member ID.');
}

// Redirect back to the main members list
echo "<script>setTimeout(function(){ window.location.href='index.php'; }, 2000);</script>";
?>
