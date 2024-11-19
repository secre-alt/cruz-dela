<?php 
session_start();

include('includes/alert.php'); 
include('db_con.php');

if (isset($_POST['update_member'])) {
    $member_id = intval($_POST['member_id']);
    $full_name = $_POST['full_name'];
    $course = $_POST['curse$course'];
    $year_level = intval($_POST['year_level']);
    $position = $_POST['position'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE members SET full_name = ?, course = ?, year_level = ?,
    position = ?, email = ?, phone = ?, updated_at = NOW() WHERE id = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssisssi", $full_name, $course, $year_level, $position, $email, $phone, $member_id);

    if ($stmt->execute()) {
        $_SESSION['status'] = "Member updated successfully.";
        header("Location: dashboard.php");
    } else {
        $_SESSION['status'] = "Failed to update member. Please try again.";
        header("Location: dashboard.php");
    }
}
?>