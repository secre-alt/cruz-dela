<?php
session_start();
include('includes/header.php');
include('db_con.php');

if (isset($_GET['id'])) {
    $memberId = intval($_GET['id']);

    // Example: Soft delete by updating a flag
    $sql = "UPDATE members SET is_deleted = 1 WHERE id = $memberId";
    
    if ($con->query($sql) === TRUE) {
        $_SESSION['status'] = "Member deleted successfully.";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Failed to delete the member.";
        $_SESSION['status_code'] = "error";
    }
}

header("Location: dashboard.php");
exit(0);
?>


