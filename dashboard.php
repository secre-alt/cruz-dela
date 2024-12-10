<?php  
error_reporting(E_ALL);
ini_set('display_errors', 1);


include('authentication.php');
$page_title = "Warehouse Dashboard";
include('includes/header.php');
include('includes/navbar.php');
include('includes/alert.php');
// Include database connection
include('db.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- Display Status Messages -->
                <?php if(isset($_SESSION['status'])): ?>
                    <div class="alert alert-success">
                        <h5><?= htmlspecialchars($_SESSION['status']); ?></h5>
                    </div>
                    <?php unset($_SESSION['status']); ?>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h4>Warehouse Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <h4>Welcome!</h4> 
                        <hr>
                        <h5>Username: <?= htmlspecialchars($_SESSION['auth_user']['username']); ?></h5>
                        <h5>Email ID: <?= htmlspecialchars($_SESSION['auth_user']['email']); ?></h5>
                        <h5>Phone No: <?= htmlspecialchars($_SESSION['auth_user']['phone']); ?></h5>
                    </div>
                </div>

                <!-- Warehouse Management Section -->
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Product Management</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="bi bi-box"></i> Add Product
                        </button>
                    </div>
                    <div class="card-body">
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM products");
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if($result->num_rows > 0): ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Stock Quantity</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($product = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($product['id']); ?></td>
                                            <td><?= htmlspecialchars($product['name']); ?></td>
                                            <td><?= htmlspecialchars($product['category']); ?></td>
                                            <td><?= htmlspecialchars($product['stock_quantity']); ?></td>
                                            <td>
                                                <a href="edit_product.php?id=<?= htmlspecialchars($product['id']); ?>" class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>                                               
                                                <a href="delete_product.php" class="btn btn-danger btn-sm" onclick="confirmDelete(<?= htmlspecialchars($product['id']); ?>)">Delete</a>                                           
                                                    <script>
                                                        function confirmDelete(productId) {
                                                            Swal.fire({
                                                                title: 'Are you sure?',
                                                                text: "You won't be able to revert this!",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonText: 'Yes, delete it!',
                                                                cancelButtonText: 'No, cancel!',
                                                                reverseButtons: true
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    // Redirect to delete product page with the product id
                                                                    window.location = "delete_product.php?id=" + productId;
                                                                } else {
                                                                    Swal.fire(
                                                                        'Cancelled',
                                                                        'The product was not deleted.',
                                                                        'error'
                                                                    )
                                                                }
                                                            });
                                                        }
                                                    </script>                                                                                                     
                                                </a>                           
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
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="add_product.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Product Name Input with Floating Label -->
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Product Name" required>
                        <label for="name">Product Name</label>
                    </div>
                    
                    <!-- Category Input with Floating Label -->
                    <div class="form-floating mb-3">
                        <input type="text" name="category" class="form-control" id="category" placeholder="Category" required>
                        <label for="category">Category</label>
                    </div>

                    <!-- Stock Quantity Input with Floating Label -->
                    <div class="form-floating mb-3">
                        <input type="number" name="stock_quantity" class="form-control" id="stock_quantity" placeholder="Stock Quantity" required>
                        <label for="stock_quantity">Stock Quantity</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Add Product Button -->
                    <button type="submit" name="add_product" class="btn btn-primary">
                        <i class="bi bi-box"></i> Add Product
                    </button>
                    <!-- Close Button -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }
    .navbar {
        background-color: #007bff;
    }
    .navbar-brand, .navbar-nav .nav-link {
        color: #fff !important;
    }
    .navbar-brand:hover, .navbar-nav .nav-link:hover {
        color: #e2e6ea !important;
    }
    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #007bff;
        color: #fff;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .table thead {
        background-color: #007bff;
        color: #fff;
    }
    .pagination .page-link {
        color: #007bff;
    }
    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

