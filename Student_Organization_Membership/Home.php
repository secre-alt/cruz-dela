<?php  
session_start();
$page_title = "Student Organization Membership Database";
include('includes/header.php');
include('includes/navbar.php');
?>

<!-- Hero Section -->
<div class="hero-section text-center py-5" style="background: linear-gradient(135deg, #6a11cb,rgb(30, 30, 31)); color: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="display-4 fw-bold">Welcome to the Student Organization Portal</h1>
                <p class="lead mb-4">Your central hub for managing memberships, events, and resources for student organizations.</p>
                <a href="register.php" class="btn btn-light btn-lg shadow-sm me-3">
                    <i class="fas fa-user-plus"></i> Join an Organization
                </a>
                <a href="login.php" class="btn btn-outline-light btn-lg shadow-sm">
                    <i class="fas fa-sign-in-alt"></i> Member Login
                </a>
                <!-- Show Members Button (Visible Only if Logged In) -->
                <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
                <div class="text-center my-5">
                    <button id="showMembersBtn" class="btn btn-dark btn-lg">
                        <i class="fas fa-list"></i> Show Members List
                    </button>
                    
                    <!-- Student Members List (Hidden by Default) -->
                    <div id="membersSection" class="members-section py-5" style="display: none;">
                        <div class="container">
                            <h2 class="text-center mb-5">Student Members List</h2>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include('db_con.php'); // Include your database connection
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
                                                </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='7' class='text-center'>No members found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="features-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Why Use Our Portal?</h2>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Membership Management</h5>
                        <p class="card-text">Easily manage member information, roles, and access privileges to keep your organization organized.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-calendar-alt fa-3x text-success mb-3"></i>
                        <h5 class="card-title">Event Registration</h5>
                        <p class="card-text">Stay informed and register for upcoming events, meetings, and activities hosted by various clubs.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-file-alt fa-3x text-info mb-3"></i>
                        <h5 class="card-title">Access Resources</h5>
                        <p class="card-text">View important documents, announcements, and resources to stay connected with your organization.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>
