<?php
session_start();

// Error reporting setup
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check authentication
if (!isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "Please Login to access User Dashboard";
    header('Location: login.php');
    exit;
}

// Page settings
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
                        <h2>
                            <?php 
                            $organizationName = $_SESSION['auth_user']['organization_name'] ?? "Your Organization";
                            echo "Welcome, <strong>" . htmlspecialchars($organizationName) . "</strong>!";
                            ?>
                        </h2>
                        <p class="text-muted mb-4">This is your hub for managing everything related to your organization. Stay connected with your members.</p>
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
                                                    <div class='d-flex justify-content-center'>
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

                            <!-- Deleted Members Section -->
                            <div class="search-bar mt-3 mb-4">
                                <input type="text" id="searchDeleted" class="form-control" placeholder="Search deleted members...">
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
                        </div>
                    </div> 
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- /.col-lg-10 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->


<?php include('includes/footer.php'); ?>
