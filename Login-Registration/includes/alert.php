<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_SESSION['status'])) {
    $status_message = $_SESSION['status'];
    $icon = 'info'; // Default icon
    $title = 'Notice!'; // Default title
    $button_text = 'OK'; // Default button text


    if (strpos($status_message, 'Success') !== false || strpos($status_message, 'verified success')) {
        $icon = 'success';
        $title = 'Salig!';
        $button_text = 'Let\'s Go!';
    } elseif (strpos($status_message, 'Oops') !== false || strpos($status_message, 'Incorrect password') !== false || 
    strpos($status_message, 'already have an account') !== false) {
        $icon = 'error';
        $title = 'Naa nakay account!';
        $button_text = 'Login';
    } elseif (stripos($status_message, 'You have successfully logged in') !== false || stripos($status_message, 'Welcome back, ') !== false) {
        $icon = 'success';
        $title = 'Welcome Back!';
        $button_text = 'Let\'s Go!';
    }
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '$icon',
                title: '$title',
                text: '" . addslashes($_SESSION['status']) . "',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        });
    </script>";

    unset($_SESSION['status']); // Clear status after displaying
}
?>

