<?php
// includes/alert.php

function showAlert($type, $title, $text) {
    $colorClass = '';
    switch ($type) {
        case 'success':
            $colorClass = '#198754'; // Bootstrap 'success' green
            break;
        case 'error':
            $colorClass = '#dc3545'; // Bootstrap 'danger' red
            break;
        case 'warning':
            $colorClass = '#ffc107'; // Bootstrap 'warning' yellow
            break;
        case 'info':
            $colorClass = '#0dcaf0'; // Bootstrap 'info' blue
            break;
        default:
            $colorClass = '#6c757d'; // Bootstrap 'secondary' gray
    }

    echo "<script>
        Swal.fire({
            icon: '$type',
            title: '$title',
            text: '$text',
            confirmButtonColor: '$colorClass', // Button color matches Bootstrap style
            customClass: {
                popup: 'border border-secondary rounded' // Add Bootstrap border-radius and border
            }
        });
    </script>";
}
?>
