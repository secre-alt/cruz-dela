<?php
$page_title = "Add Products";
include('includes/header.php');
include('includes/navbar.php');

// Include database connection
include('db.php');

if(isset($_POST['add_product'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $category = $_POST['category'];
    $stock_quantity = $_POST['stock_quantity'];

    // Prepare SQL query to insert data
    $stmt = $conn->prepare("INSERT INTO products (name, category, stock_quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $category, $stock_quantity);

    // Execute query and check if successful
    if($stmt->execute()) {
        // Redirect with success alert
        echo '<script type="text/javascript">
            Swal.fire({
                title: "Product Added!",
                text: "Your product has been successfully added.",
                icon: "success",
                confirmButtonText: "OK",
                showConfirmButton: true
            }).then(function() {
                window.location = "dashboard.php"; // Redirect to dashboard after successful product addition
            });
        </script>';
    } else {
        // Show error alert
        echo '<script type="text/javascript">
            Swal.fire({
                title: "Error!",
                text: "There was an issue adding the product. Please try again.",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>';
    }
}
?>


<div class="container mt-5">
    <h2>Add New Product</h2>

    <!-- Display status message -->
    <?php if(isset($_SESSION['status'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['status']; ?>
        </div>
        <?php unset($_SESSION['status']); ?>
    <?php endif; ?>

    <form action="add_product.php" method="POST">
        <!-- Product Name Input -->
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <!-- Product Category Input -->
        <div class="mb-3">
            <label for="category" class="form-label">Product Category</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>

        <!-- Product Stock Quantity Input -->
        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Stock Quantity</label>
            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
    </form>
</div>


<?php include('includes/footer.php');?>