<div class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold text-uppercase" href="#">Warehouse Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="index.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <?php if (!isset($_SESSION['authenticated'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="register.php"><i class="fas fa-user-plus"></i> Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                        </li>
                    <?php endif ?>
                    <?php if (isset($_SESSION['authenticated'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
</div>


<style>
.navbar {
    background: #1a1a1a; /* Dark Gray/Black background */
    border-bottom: 2px solid #00aaff; /* Bright Blue Highlight */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
}

.navbar-brand {
    font-size: 1.8rem;
    font-weight: bold;
    color: #00aaff; /* Neon Blue */
}

.navbar-toggler {
    border: none;
    color: #00aaff;
}

.nav-link {
    color: #f0f0f0; /* Light Gray */
    font-size: 1rem;
    margin-right: 15px;
    transition: color 0.3s ease, transform 0.3s ease;
}

.nav-link:hover {
    color: #00ff88; /* Neon Green */
    transform: scale(1.1);
    text-decoration: none;
}

.navbar-nav .nav-item:last-child .nav-link {
    margin-right: 0;
}

.navbar .collapse {
    justify-content: flex-end;
}

.navbar .fas {
    margin-right: 5px;
}

</style>