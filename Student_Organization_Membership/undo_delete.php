<?php
session_start();

include('db_con.php');


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);


    $sql = "UPDATE members SET is_deleted = 0 WHERE id = $id";

    if ($con->query($sql) === TRUE) {
        $_SESSION['status'] = "Member restored successfully!";
        header('Location: dashboard.php');
    } else {
        $_SESSION['status'] = "Failed to restore member. Please try again.";
        header('Location: dashboard.php');
    }
} else {
    $_SESSION['status'] = "Invalid member ID.";
    header('Location: dashboard.php');
}
?>

<?php include('includes/footer.php'); ?>