<?php
if (isset($_SESSION['status'])):
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        title: 'Notification',
        text: '<?= addslashes($_SESSION['status']); ?>',
        icon: '<?= isset($_SESSION['status_icon']) ? addslashes($_SESSION['status_icon']) : 'success'; ?>',
        confirmButtonText: 'OK'
    });
</script>
<?php
unset($_SESSION['status']);
unset($_SESSION['status_icon']);
endif;
?>
