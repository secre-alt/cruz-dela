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


// Toggle visibility of the members list
document.getElementById('showMembersBtn')?.addEventListener('click', function() {
    const membersSection = document.getElementById('membersSection');
    if (membersSection.style.display === 'none') {
        membersSection.style.display = 'block';
        this.innerHTML = '<i class="fas fa-times"></i> Hide Members List';
    } else {
        membersSection.style.display = 'none';
        this.innerHTML = '<i class="fas fa-list"></i> Show Members List';
    }
});

