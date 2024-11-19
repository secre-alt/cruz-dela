<?php 
session_start();
include('includes/header.php');
include('includes/alert.php');
include('db_con.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Perform the soft delete
    $sql = "UPDATE members SET is_deleted = 1 WHERE id = $id";

    if ($con->query($sql) === TRUE) {
        $_SESSION['status'] = "Member deleted successfully!";
        header('Location: dashboard.php');
    } else {
        $_SESSION['status'] = "Failed to delete member. Please try again.";
        header('Location: dashboard.php');
    }
} else {
    $_SESSION['status'] = "Invalid member ID.";
    header('Location: dashboard.php');
}

include('includes/footer.php');
?>
