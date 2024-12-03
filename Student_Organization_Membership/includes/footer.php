  
<!-- Bootstrap JS (with Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  
<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTables for Members Table
        $('#membersTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthChange: true,
            order: [[0, 'asc']], // Sort by the first column (ID) by default
            language: {
                search: "Search Members:",
                paginate: {
                    previous: "Previous",
                    next: "Next"
                }
            }
        });

        // Initialize DataTables for Events Table
        $('#eventsTable').DataTable({
            responsive: true,
            pageLength: 5,
            lengthChange: true,
            order: [[2, 'asc']], // Sort by the Date column by default
            language: {
                search: "Search Events:",
                paginate: {
                    previous: "Previous",
                    next: "Next"
                }
            }
        });
    });
    </script>

    <script>
            document.addEventListener("DOMContentLoaded", function() {
                const deleteButtons = document.querySelectorAll('.delete-btn');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const memberId = this.getAttribute('data-id');

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You can still undo this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (memberId) {
                                    window.location.href = 'delete_member.php?id=' + memberId;
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'No member ID found for deletion.'
                                    });
                                }
                            }
                        });
                    });
                });
            });
        </script>


        <script>
        document.querySelectorAll('.btn-undo').forEach(button => {
            button.addEventListener('click', function () {
                const memberId = this.getAttribute('data-id');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You can still undo this action!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, undo it!',
                    cancelButtonText: 'No, cancel!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to undo the delete action
                        window.location.href = `undo_delete.php?id=${memberId}`;
                    }
                });
            });
        });
        </script>

</body>
</html>