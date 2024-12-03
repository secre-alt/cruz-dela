<?php 
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if user is authenticated
if (!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Please Login to access User Dashboard";
    header('Location: login.php');
    exit(0);
}

$page_title = "Dashboard";
include('includes/header.php');
include('includes/navbar.php');
include('db_con.php');
?>

<div class="container my-5"> 
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <?php include('includes/alert.php'); ?>
  
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-dark text-white text-center rounded-top">
                    <h3 class="mb-0"><i class="bi bi-building me-2"></i> Organization Dashboard</h3>
                </div>
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h3>
                            <?php 
                            $organizationName = $_SESSION['auth_user']['organization_name'] ?? "Your Organization";
                            echo "Welcome, <strong>" . htmlspecialchars($organizationName) . "</strong>!";
                            ?>
                        </h3>
                        <p class="text-muted mb-4">This is your hub for managing everything related to your organization. Easily update your profile, adjust settings, and stay connected with your members.</p>
                    </div>

                    <!-- Divider with icon for better UX -->
                    <div class="d-flex justify-content-center align-items-center my-4">
                        <hr class="flex-grow-1">
                        <span class="px-3 text-muted manage-text">
                            <i class="bi bi-gear-fill me-2"></i>Manage Your Organization   
                        </span>
                        <hr class="flex-grow-1">
                    </div>

                     <div class="d-flex justify-content-center gap-3 my-3">
                    <a href="add_member.php" class="btn btn-dark btn-sm">Add Member</a>
                    <a href="view_events.php" class="btn btn-secondary btn-sm">View Events</a>
                    <a href="settings.php" class="btn btn-outline-secondary btn-sm">Settings</a>
                </div>
                
                <div class="deleted-section mt-5">
                        <h2>Deleted Members</h2>
                        <?php
                        $deleted_sql = "SELECT * FROM members WHERE is_deleted = 1";
                        $deleted_result = $con->query($deleted_sql);

                        if ($deleted_result && $deleted_result->num_rows > 0) {
                            while ($row = $deleted_result->fetch_assoc()) {
                                echo "<div class='deleted-member mb-3'>
                                        <p>" . htmlspecialchars($row['full_name']) . "</p>
                                        <a href='#' class='btn btn-undo btn-sm' data-id='" . htmlspecialchars($row['id']) . "'>Undo</a>
                                      </div>";
                            }
                        } else {
                            echo "<p>No deleted members</p>";
                        }
                        ?>
                    </div>

                    <hr class="my-4">

                    <!-- Members List -->
                    <div class="mt-4">
                        <h2>Members List</h2>
                        <a href="add_member.php" class="btn btn-dark mb-3">Add Member</a>
                        <div class="table-responsive">
                            <table id="membersTable" class="table table-hover table-bordered">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Course</th>
                                        <th>Year Level</th>
                                        <th>Position</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch members from the database
                                    $sql = "SELECT * FROM members WHERE is_deleted = 0";
                                    $result = $con->query($sql);

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                <td class='text-center'>" . htmlspecialchars($row['id']) . "</td>
                                                <td>" . htmlspecialchars($row['full_name']) . "</td>
                                                <td>" . htmlspecialchars($row['course']) . "</td>
                                                <td class='text-center'>" . htmlspecialchars($row['year_level']) . "</td>
                                                <td>" . htmlspecialchars($row['position']) . "</td>
                                                <td>" . htmlspecialchars($row['email']) . "</td>
                                                <td>" . htmlspecialchars($row['phone']) . "</td>
                                                <td class='text-center'>
                                                    <div class='d-flex justify-content-center w-100'>
                                                    <a href='edit_member.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm me-1'>Edit</a>
                                                    <button type='button' class='btn btn-danger btn-sm delete-btn' data-id='" . htmlspecialchars($row['id']) . "'>Delete</button>
                                                   </div>
                                                    </td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center no-records'>No members found</td></tr>";
                                    }
                                    ?>      
                                </tbody>
                            </table>                         
                        </div>
                    </div>

                   

                    <!-- Event Tracker Section -->
                    <div class="mt-5">
                        <h2>Upcoming Events</h2>
                        <a href="add_event.php" class="btn btn-dark mb-3">Add Events</a>
                        <div class="table-responsive">
                            <table id="eventsTable" class="table table-hover table-bordered">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Event Name</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php 
                                    
                                    $sql = "SELECT * FROM events ORDER BY event_date ASC";
                                    $result = $con->query($sql);

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                                <td class='text-center'>" . htmlspecialchars($row['id']) . "</td>
                                                <td>" . htmlspecialchars($row['event_name']) . "</td>
                                                <td>" . htmlspecialchars($row['event_date']) . "</td>
                                                <td>" . htmlspecialchars($row['location']) . " </td>
                                                <td>" . htmlspecialchars($row['description']) . "</td>
                                                <td class='text-center'> 
                                                   <div class='d-flex justify-content-center w-100'>
                                                     <a href='edit_event.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm me-1'>Edit</a>
                                                    <a href='delete_event.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm'>Delete</a>
                                                   </div>
                                                 </td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center no-records'>No upcoming events yet</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col-lg-10 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->

<style>
    .card-body {
        background-color: #f8f9fa;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .card-body h5 {
    font-size: 1.25rem;
    color: #333;
    font-weight: 600;
    }

    .card-body p {
        font-size: 1.1rem;
        color: #666;
    }

    .manage-text {
        font-size: 1.1rem;
        font-weight: 500;
    }

    
    /* Table Styling */
    .table {
        margin-top: 1rem;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 8px;
        overflow: hidden;
        background-color: #ffffff; /* Table background */
    }

    /* Header Row Styling */
    .table thead th {
        background-color: #343a40; /* Dark header background */
        color: #ffffff; /* White text for header */
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.9rem;
        border: 1px solid #343a40; /* Border matches header background */
    }

    /* Table Body Row Styling */
    .table tbody tr {
        transition: background-color 0.3s ease;
    }

    /* Hover Effect */
    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Data Cell Styling */
    .table tbody td {
        padding: 0.8rem;
        vertical-align: middle;
        border: 1px solid #dee2e6; /* Light border for better separation */
    }

    /* Centered Text for Specific Columns */
    .text-center {
        text-align: center;
    }

    /* Action Buttons */
    .table tbody .btn {
        font-size: 0.8rem;
        padding: 0.3rem 0.5rem;
    }

    /* No Records Found Message Styling */
    .no-records {
        color: #666;
        font-size: 1rem;
        font-weight: 500;
    }

    /* Responsive Table Scroll */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Highlight Deleted Member Section */
    .deleted-section {
        margin-top: 2rem;
        padding: 1rem;
        border: 1px dashed #ccc;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .deleted-section h2 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    .deleted-section .btn {
        margin-left: 0.5rem;
        padding: 0.3rem 0.6rem;
        font-size: 0.85rem;
    }


    .dataTables_wrapper .dataTables_filter input {
        width: 300px; /* Adjust search box width */
        border-radius: 5px;
        padding: 5px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.3rem 0.6rem;
        border-radius: 4px;
        color: #fff;
        background-color: #343a40;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #495057;
    }

    .dataTables_length select {
    appearance: none; /* Reset custom styling */
    -webkit-appearance: none; /* For Safari */
    -moz-appearance: none; /* For Firefox */
    border: 1px solid #ccc; /* Add a border */
    padding: 5px; /* Adjust padding */
    background: none; /* Ensure no background is added */
    }

    .dataTables_length::before, 
    .dataTables_length::after {
        content: none; /* Remove any pseudo-elements */
    }

    
</style>

<style>
/* Styling for Deleted Members Section */
.deleted-section {
    margin-top: 2rem;
    padding: 1rem;
    border: 1px dashed #ccc;
    border-radius: 8px;
    background-color: #f9f9f9;
}

.deleted-section h2 {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

.deleted-member {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f9f9f9;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    margin-top: 10px;
}

.deleted-member p {
    font-size: 1.1rem;
    color: #333;
    margin: 0;
}

.deleted-member .btn-undo {
    margin-left: 10px;
}

/* Styling for the Undo Button */
.btn-undo {
    background-color: #28a745; /* Green color for undo */
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 8px 16px;
    font-size: 0.9rem;
    text-transform: uppercase;
    font-weight: 600;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

/* Hover Effect */
.btn-undo:hover {
    background-color: #218838; /* Darker green */
    transform: scale(1.05);
}

</style>

<?php include('includes/footer.php'); ?>
