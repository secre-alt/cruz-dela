<div class="alert">
    <?php 
    if (isset($_SESSION['status'])) {
        // Set the alert type and icon based on the status message
        $alertType = 'info'; // Default to info
        $icon = '<i class="fas fa-info-circle"></i>';

        if (strpos($_SESSION['status'], 'successfully') !== false) {
            $alertType = 'success';
            $icon = '<i class="fas fa-check-circle"></i>';
        } elseif (strpos($_SESSION['status'], 'Failed') !== false) {
            $alertType = 'danger';
            $icon = '<i class="fas fa-times-circle"></i>';
        } elseif (strpos($_SESSION['status'], 'already verified') !== false) {
            $alertType = 'warning';
            $icon = '<i class="fas fa-exclamation-circle"></i>';
        }

        // Display the alert
        echo '<div class="alert alert-' . $alertType . ' alert-dismissible fade show" role="alert">';
        echo $icon . ' ' . $_SESSION['status'];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';

        unset($_SESSION['status']);
    }
    ?>
</div>

