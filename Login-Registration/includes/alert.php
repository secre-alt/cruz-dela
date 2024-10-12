<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_SESSION['status'])) {
    $icon = 'info'; // Default icon
    if (strpos($_SESSION['status'], 'Success') !== false) {
        $icon = 'success';
    } elseif (strpos($_SESSION['status'], 'Oops') !== false) {
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

