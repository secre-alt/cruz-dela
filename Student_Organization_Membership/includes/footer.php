  
<!-- Bootstrap JS (with Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function () {
        $('#membersTable').DataTable({
            paging: true,         // Enable pagination
            searching: true,      // Enable search
            ordering: true,       // Enable sorting
            lengthMenu: [5, 10, 25, 50], // Page length options
            language: {
                search: "Filter records:", // Customize search box placeholder
            }
        });
    });
</script>

</body>
</html>