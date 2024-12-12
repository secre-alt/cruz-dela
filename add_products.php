<?php 
session_start();
$page_title = "Add Product";
include('includes/header.php');
include('includes/navbar.php');
include('includes/alert.php');
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
        // Set session status for success
        $_SESSION['status'] = "Product Added! Your product has been successfully added.";
        $_SESSION['status_type'] = "success"; // You can also use this for SweetAlert type (success, error, etc.)
        
        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Set session status for error
        $_SESSION['status'] = "Error! There was an issue adding the product. Please try again.";
        $_SESSION['status_type'] = "error"; // Error status
        
        // Redirect back to the page to show the error
        header("Location: add_product.php"); // Or the page you're on
        exit();
    }
}
?>

<div class="py-5 bg-light"> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Alert Messages -->
                <div class="alert <?php echo isset($_SESSION['status']) ? (strpos($_SESSION['status'], 'Success') !== false ? 'alert-success' : (strpos($_SESSION['status'], 'exists') !== false ? 'alert-warning' : 'alert-danger')) : ''; ?> alert-dismissible fade show" role="alert">
                    <?php 
                        if (isset($_SESSION['status'])) { 
                            if (strpos($_SESSION['status'], 'Success') !== false) {
                                echo "<i class='fas fa-check-circle'></i> " . $_SESSION['status'];
                            } elseif (strpos($_SESSION['status'], 'exists') !== false) {
                                echo "<i class='fas fa-exclamation-circle'></i> " . $_SESSION['status'];
                            } else {
                                echo "<i class='fas fa-times-circle'></i> " . $_SESSION['status'];
                            }
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            unset($_SESSION["status"]); // Clear status after displaying
                        }
                    ?>
                </div>
                
                <div class="card shadow-lg">
                    <div class="card-header custom-header text-white">
                        <h5 class="mb-0">Add New Product</h5> 
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <!-- Product Name -->
                            <div class="form-group mb-3 position-relative"> 
                                <label for="name">Product Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter product name" required>
                                </div>
                            </div>
                            
                            <!-- Product Category -->
                            <div class="form-group mb-3 position-relative"> 
                                <label for="category">Product Category</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    <input type="text" id="category" name="category" class="form-control" placeholder="Enter product category" required>
                                </div>
                            </div>
                            
                            <!-- Stock Quantity -->
                            <div class="form-group mb-3 position-relative"> 
                                <label for="stock_quantity">Stock Quantity</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-cogs"></i></span>
                                    <input type="number" id="stock_quantity" name="stock_quantity" class="form-control" placeholder="Enter stock quantity" required>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" name="add_product" class="btn btn-primary w-100">
                                    <i class="fas fa-check-circle"></i> Add Product
                                </button> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
  /* Background with subtle gradient */
.py-5.bg-light {
    background: linear-gradient(to bottom right, #d0e7ff, #8db5e8);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 0;
}

/* Card header with bold style */
.custom-header {
    background-color: #003366; /* Dark navy blue */
    color: white;
    font-family: 'Roboto', sans-serif; /* Clean, modern font */
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
    padding: 1rem 0;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}

.card-body {
    background-color: #f5f5f5; /* Light grey */
    border-radius: 0.5rem;
    padding: 2rem;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Stronger shadow */
}

/* Input group styles */
.input-group-text {
    background-color: #00509e; /* Blue tone */
    color: white;
    border: none;
}

.form-control {
    border: 2px solid #8db5e8; /* Light blue border */
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    font-family: 'Roboto', sans-serif;
    font-size: 1rem;
}

.form-control:focus {
    border-color: #00509e; /* Focused blue border */
    box-shadow: 0 0 10px rgba(0, 80, 158, 0.6);
}

/* Button styles */
.btn-primary {
    background-color: #003366; /* Navy blue */
    border: none;
    color: white;
    font-size: 1rem;
    font-weight: bold;
    padding: 0.75rem;
    border-radius: 0.5rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.btn-primary:hover {
    background-color: #00509e; /* Lighter blue on hover */
    transform: scale(1.05);
    box-shadow: 0 4px 10px rgba(0, 80, 158, 0.6);
}

/* Link styles */
a {
    color: #00509e;
    font-weight: bold;
    transition: color 0.3s ease;
}

a:hover {
    color: #003366;
    text-decoration: underline;
}

/* Form labels */
.form-group label {
    color: #003366;
    font-family: 'Roboto', sans-serif;
    font-weight: bold;
}

/* Alerts: Success, Warning, and Error */
.alert-success {
    background-color: #d1e7dd;
    color: #0f5132;
    border-left: 5px solid #0f5132;
}

.alert-warning {
    background-color: #fff3cd;
    color: #664d03;
    border-left: 5px solid #664d03;
}

.alert-danger {
    background-color: #f8d7da;
    color: #842029;
    border-left: 5px solid #842029;
}

/* Header styles for the registration form */
h5.mb-0 {
    font-family: 'Roboto', sans-serif;
    font-size: 1.5rem;
    color: white;
}

/* Button focus styles */
.btn-primary:focus {
    outline: none;
    box-shadow: 0 0 10px rgba(0, 80, 158, 0.6);
}
</style>

<script>
    <?php if (isset($_SESSION['status'])) { ?>
        Swal.fire({
            icon: '<?php echo (strpos($_SESSION['status'], 'Success') !== false ? 'success' : (strpos($_SESSION['status'], 'exists') !== false ? 'warning' : 'error')); ?>',
            title: '<?php echo $_SESSION['status']; ?>',
            showConfirmButton: false,
            timer: 2000
        });
    <?php unset($_SESSION['status']); } ?>
</script>

<?php include('includes/footer.php'); ?>
