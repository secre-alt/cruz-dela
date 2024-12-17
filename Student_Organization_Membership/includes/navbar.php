<?php 
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="bg-dark-custom" id="navbar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <a class="text-warning navbar-brand" href="#">Student Organization Portal</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($current_page == 'Home.php') echo 'active'; ?>" href="Home.php">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($current_page == 'dashboard.php') echo 'active'; ?>" href="dashboard.php">
                                        Dashboard
                                    </a>
                                </li>
                                <?php if(!isset($_SESSION['authenticated'])) :?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($current_page == 'register.php') echo 'active'; ?>" href="register.php">
                                        Sign up
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($current_page == 'login.php') echo 'active'; ?>" href="login.php">
                                       Login
                                    </a>
                                </li>
                                <?php endif ?>

                                <?php if(isset($_SESSION['authenticated'])) :?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if ($current_page == 'logout.php') echo 'active'; ?>" href="logout.php">
                                        Logout
                                    </a>
                                </li>
                                <?php endif ?>

                                <button onclick="toggleDarkMode()" class="btn btn-outline-light">
                                    <i class="bi bi-moon-fill"></i> 
                                </button>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-dark-custom {
        background: linear-gradient(45deg, #1a1a1a, #0d0d0d); 
        padding: 1rem 0;
    }

    .navbar-dark .navbar-brand, .navbar-dark .nav-link {
        color: rgba(255, 255, 255, 0.85);
        transition: color 0.3s ease;
        font-weight: bold;
    }

    .navbar-brand {
        color: #ffff00;
        font-size: 30px;
    }

    .navbar-dark .nav-link:hover {
        color: #f8f9fa;
    }

    .navbar-dark .nav-link.active {
        color: #fff;
        border-bottom: 2px solid #f8f9fa;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%28255, 255, 255, 0.7%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }

    body.dark-mode {
        background: linear-gradient(45deg, #2a2a2a, #3b3b3b);
        color: #eaeaea;
    }

    .navbar.dark-mode {
        background: linear-gradient(45deg, #2c2c2c, #3b3b3b);
    }

    .navbar.dark-mode .navbar-brand,
    .navbar.dark-mode .nav-link {
        color: #eaeaea;
    }

    /* Dark mode styles */
    body.dark-mode .card {
        background-color: #2a2a2a !important; /* Dark background for cards */
        color: #eaeaea !important; /* Light text */
    }

    body.dark-mode .card-header {
        background-color: #343a40 !important;
        color: #ffffff !important;
    }

    body.dark-mode .table {
        background-color: #2a2a2a;
        color: #eaeaea;
    }

    body.dark-mode .table thead th {
        background-color: #444444; /* Darker header */
        color: #ffffff;
    }

    body.dark-mode .table tbody tr:hover {
        background-color: #3b3b3b; /* Hover effect in dark mode */
    }

</style>

<script>
    const toggleButton = document.getElementById('toggleDarkMode');
    const body = document.body;
    const navbar = document.getElementById('navbar');
    const icon = document.getElementById('darkModeIcon');

    toggleButton.addEventListener('click', () => {
        const isDarkMode = body.classList.toggle('dark-mode');
        navbar.classList.toggle('dark-mode', isDarkMode);

        // Toggle between moon and sun icons
        icon.classList.toggle('bi-moon-fill', !isDarkMode);
        icon.classList.toggle('bi-sun-fill', isDarkMode);
    });
</script>
