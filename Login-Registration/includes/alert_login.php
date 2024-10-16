<?php
if (isset($_SESSION['status'])) {
    $status_message = $_SESSION['status']; // Store the session status in a variable
    $icon = 'info'; // Default icon
    $title = 'Notification'; // Default title
    $button_text = 'OK'; // Default button text

    // Check for success, warning, or error messages
    if (strpos($status_message, 'You have successfully logged in') !== false) {
        $icon = 'success';
        $title = 'Welcome Back!';
        $button_text = 'Let\'s Go!';
    } elseif (strpos($status_message, 'Success') !== false || strpos($status_message, 'verified successfully') !==false) {
        $icon = 'success';
        $title = 'Success!';
        $button_text = 'Let\'s Go!';
    } elseif (strpos($status_message, 'hasn\'t been verified') !== false) {
        $icon = 'warning';
        $title = 'Verify Your Email';
        $button_text = 'Check Inbox';
    } elseif (strpos($status_message, 'incorrect') !== false || strpos($status_message, 'not registered') !== false) {
        $icon = 'error';
        $title = 'Login Failed';
        $button_text = 'Try Again';
    } elseif (strpos($status_message, 'All fields are required') !== false) {
        $icon = 'warning';
        $title = 'Incomplete Fields';
        $button_text = 'Fill Details';
    } elseif (strpos($status_message, 'already been verified') !== false) {
        $icon = 'info';
        $title = 'Please Login';
        $button_text = 'Login';
    }

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '$icon',
                title: '$title',
                html: '" . addslashes($status_message) . "',
                confirmButtonColor: '#3085d6',
                confirmButtonText: '$button_text',
                background: '#f0f0f0', // Light background for better contrast
                customClass: {
                    popup: 'swal-custom-popup', // Add custom class for styling
                    title: 'swal-custom-title',
                    content: 'swal-custom-content',
                    confirmButton: 'swal-custom-button'
                }
            });
        });
    </script>";

    unset($_SESSION['status']); // Clear status after displaying
}
?>
