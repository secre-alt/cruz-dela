<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize DataTables
        $('#membersTable').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[0, 'asc']],
            language: {
                search: "Search Members:",
                paginate: { previous: "Previous", next: "Next" }
            }
        });

        $('#eventsTable').DataTable({
            responsive: true,
            pageLength: 5,
            order: [[2, 'asc']],
            language: {
                search: "Search Events:",
                paginate: { previous: "Previous", next: "Next" }
            }
        });

        // Delete Button
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
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
                    if (result.isConfirmed && memberId) {
                        window.location.href = `delete_member.php?id=${memberId}`;
                    }
                });
            });
        });

        // Undo Button
        document.querySelectorAll('.btn-undo').forEach(button => {
            button.addEventListener('click', function () {
                const memberId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You can still undo this action!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, undo it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed && memberId) {
                        window.location.href = `undo_delete.php?id=${memberId}`;
                    }
                });
            });
        });

        // Search Deleted Members
        document.getElementById('searchDeleted').addEventListener('input', function () {
            const query = this.value.toLowerCase();
            document.querySelectorAll('.deleted-member').forEach(member => {
                const memberName = member.querySelector('p').innerText.toLowerCase();
                member.style.display = memberName.includes(query) ? 'flex' : 'none';
            });
        });
    });

    // Toggle Dark Mode
    const toggleDarkMode = () => {
        const body = document.body;
        const isDarkMode = body.classList.toggle('dark-mode');

        fetch('set_dark_mode.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ darkMode: isDarkMode }),
        });
    };
</script>
