<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_SESSION['status'])) {
    $status_message = $_SESSION['status'];
    $icon = 'info'; // Default icon

    if (strpos($status_message, 'Success') !== false || strpos($status_message, 'verified success')) {
        $icon = 'success';
    } elseif (strpos($status_message, 'Oops') !== false || strpos($status_message, 'Incorrect password') !== false
    strpos($status_message, 'Invald Email or Passwrod') !== false) {
        $icon = 'error';
    }

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '$icon',
                title: 'Status',
                text: '" . addslashes($_SESSION['status']) . "',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        });
    </script>";

    unset($_SESSION['status']); // Clear status after displaying
}
?>

