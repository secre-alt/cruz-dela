<?php 
include('includes/header.php');
include('db.php');
include('includes/alert.php');


if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        $_SESSION['status'] = "Product successfully deleted!";
        $_SESSION['status_icon'] = "success";
    } else {
        $_SESSION['status'] = "Error deleting the product. Please try again.";
        $_SESSION['status_icon'] = "error";
    }

    header("Location: dashboard.php");
    exit();
}
?>

<?php include('includes/footer.php');?>