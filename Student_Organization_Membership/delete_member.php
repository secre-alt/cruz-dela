<?php 
session_start();
include('includes/header.php');
include('includes/alert.php');
include('db_con.php');


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Sure ka?',
                text: 'Basin magmahay ka!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Di sa lang'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, send a request to delete the member
                    window.location.href = 'delete_member_action.php?id=$id';
                } else {
                    // If cancelled, redirect back to the dashboard
                    window.location.href = 'dashboard.php';
                }
            });
        });
    </script>";
} else {
    showAlert('error', 'Error', 'Invalid member ID.', 'dashboard.php');
}
include('includes/footer.php');
?>
