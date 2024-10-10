<?php  
if (isset($_SESSION['status'])) { 
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {";

    // Success alert
    if (strpos($_SESSION['status'], 'Success') !== false) {
        echo "Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '" . $_SESSION['status'] . "',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });";
    } 
    // Warning alert (e.g., user exists)
    elseif (strpos($_SESSION['status'], 'exists') !== false) {
        echo "Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: '" . $_SESSION['status'] . "',
            confirmButtonColor: '#f0ad4e',
            confirmButtonText: 'OK'
        });";
    } 
    // Error alert
    else {
        echo "Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '" . $_SESSION['status'] . "',
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });";
    }

    echo "});
    </script>";

    // Clear the session status after displaying the alert
    unset($_SESSION['status']);
}
?>
