<?php 
session_start();
include('db_config.php');
include('includes/header.php');  ?>


    <div class="container mt-5">
        <h1>Members List</h1>
        <a href="add_member.php" class="btn btn-primary mb-3">Add Member</a>
        <table class="table table-bordered">
            <thead>
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
                $sql = "SELECT * FROM members";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['full_name']}</td>
                            <td>{$row['course']}</td>
                            <td>{$row['year_level']}</td>
                            <td>{$row['position']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>
                                <a href='edit_member.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_member.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
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

    <?php include('includes/footer.php'); ?>