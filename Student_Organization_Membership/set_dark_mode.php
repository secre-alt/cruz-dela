<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['darkMode'])) {
    $_SESSION['dark_mode'] = $data['darkMode'];
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>


<?php include('includes/footer.php'); ?>
