<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('authentication.php');
$page_title = "Warehouse Dashboard";
include('includes/header.php');
include('includes/navbar.php');
include('includes/alert.php');
include('db.php'); // Database connection

// Fetch total products and stock quantity
data_fetch($conn);

// Pagination setup
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$product_result = $stmt->get_result();


function data_fetch($conn) {
    $stmt = $conn->prepare("SELECT COUNT(*) AS total_products, SUM(stock_quantity) AS total_stock FROM products");
    $stmt->execute();
    $result = $stmt->get_result();
    $GLOBALS['data'] = $result->fetch_assoc();
}
?>

 <?php if (isset($_SESSION['status'])): ?>
<script>
    Swal.fire({
        icon: '<?= $_SESSION['status_icon']; ?>',
        title: '<?= $_SESSION['status']; ?>',
        showConfirmButton: false,
        timer: 2000
    });
</script>
<?php unset($_SESSION['status'], $_SESSION['status_icon']); ?>
<?php endif; ?>

<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Warehouse Dashboard</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Overview</h5>
                    <p><strong>Total Products:</strong> <?= $GLOBALS['data']['total_products'] ?></p>
                    <p><strong>Total Stock Quantity:</strong> <?= $GLOBALS['data']['total_stock'] ?></p>
                </div>
            </div>
            <a href="add_products.php" class="btn btn-dark">
                <i class="bi bi-box"></i> Add Product
            </a>
            <div class="table-responsive">
                <?php if ($product_result->num_rows > 0): ?>
                    <!-- Add id to the table for DataTables -->
                    <table id="productsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($product = $product_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($product['id']); ?></td>
                                    <td><?= htmlspecialchars($product['name']); ?></td>
                                    <td><?= htmlspecialchars($product['category']); ?></td>
                                    <td><?= htmlspecialchars($product['stock_quantity']); ?></td>
                                    <td>
                                        <a href="edit_products.php?id=<?= $product['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $product['id']; ?>)">Delete</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No products found. Add a new product to get started!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize DataTables
    $(document).ready(function() {
        $('#productsTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "search": "Search Products:",
                "paginate": {
                    "next": "Next Page",
                    "previous": "Previous Page"
                }
            }
        });
    });

    // Confirm delete function
    function confirmDelete(productId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to undo this action!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `delete_product.php?id=${productId}`;
            }
        });
    }
</script>



<style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }

    /* Card Styling */
    .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #343a40; /* Darker shade for header */
        color: #fff;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .table thead th {
        color: #fff; /* White font for headers */
        background-color: #343a40; /* Dark background for headers */
    }
    .table tbody tr td {
        color: #212529; /* Dark font for body cells */
    }
    .table tbody tr:hover td {
        background-color: #f8f9fa; /* Light gray background on hover */
    }

    /* Button Styling */
    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 5px;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        border-radius: 5px;
    }
    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        border-radius: 5px;
    }
    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Pagination Styling */
    .pagination .page-link {
        color: #007bff;
    }
    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }

    /* Alert Styling */
    .alert {
        border-radius: 5px;
    }

    /* Style DataTables Headers */
    .dataTables_wrapper .dataTables_filter input {
        border: 2px solid #343a40;
        border-radius: 5px;
        padding: 5px 10px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        background-color: #343a40 !important;
        color: #fff !important;
        border-radius: 5px;
        margin: 0 5px;
        padding: 5px 10px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #007bff !important;
        color: white !important;
    }

    .dataTables_wrapper .dataTables_info {
        color: #343a40;
    }
 
</style>

<?php include('includes/footer.php'); ?>
