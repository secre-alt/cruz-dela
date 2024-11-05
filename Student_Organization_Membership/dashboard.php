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
include('includes/db_config.php');
?>

<div class="container my-5"> 
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <?php include('includes/alert.php'); ?>

            
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center rounded-top">
                    <h3 class="mb-0"><i class="bi bi-building me-2"></i> Organization Dashboard</h3>
                </div>
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h5>
                            <?php 
                            $organizationName = $_SESSION['auth_user']['organization_name'] ?? "Your Organization";
                            echo "Welcome, <strong>" . htmlspecialchars($organizationName) . "</strong>!";
                            ?>
                        </h5>
                        <p class="text-muted mb-4">This is your hub for managing everything related to your organization. Easily update your profile, adjust settings, and stay connected with your members.</p>
                    </div>

                    <!-- Divider with icon for better UX -->
                    <div class="d-flex justify-content-center align-items-center my-4">
                        <hr class="flex-grow-1">
                        <span class="px-3 text-muted small">Manage Your Organization</span>
                        <hr class="flex-grow-1">
                    </div>

                    

                    <hr class="my-4">

                    <!-- Members List -->
                    <div class="mt-4">
                        <h2>Members List</h2>
                        <a href="add_member.php" class="btn btn-primary mb-3">Add Member</a>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
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
                                    $sql = "SELECT * FROM members";
                                    $result = $conn->query($sql);

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
                                                    <a href='edit_member.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm me-1'>Edit</a>
                                                    <a href='delete_member.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm'>Delete</a>
                                                </td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center'>No members found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>                         
                        </div>
                    </div>

                    <!-- Event Tracker Section -->
                    <div class="mt-5">
                        <h2>Upcoming Events</h2>
                        <a href="add_event.php" class="btn btn-primary mb-3">Add Events</a>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-dark text-center">
                                        <th>ID</th>
                                        <th>Event Name</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                    <?php 
                                    
                                    $sql = "SELECT * FROM events ORDER BY event_date ASC";
                                    $result = $conn->query($sql);

                                    if ($result && $result->num_rows > 0) {
                                        while ($row = $reult->fetch_assoc()) {
                                            echo "<tr>
                                                <td class='text-center'> " . htmlspecialchars($row['id']) . " </td>
                                                <td> " . htmlspecialchars($row['event_name']) . " </td>
                                                <td> " . htmlspecialchars($row['event_date']) . " </td>
                                                <td> " . htmlspecialchars($row['location']) . " </td>
                                                <td> " . htmlspecialchars($row['description']) . " </td>
                                                <td class='text-center'> 
                                                    <a href='edit_event.php'
                                                </td>
                                            </tr?";
                                        }
                                    }
                                    ?>
                            </table>
                        </div>
                    </div> 
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col-lg-10 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->

<?php include('includes/footer.php'); ?>
