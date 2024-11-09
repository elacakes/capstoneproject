<nav class="navbar navbar-expand-lg shadow sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../img/puncan logo.png" alt="Brand" class="img-fluid" style="height: 60px; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
                <li class="nav-item">
                    <a class="btn btn-custom-logout" href="../logout.php" 
                       style="font-family: 'Segoe UI', sans-serif;">
                        <i class="fas fa-sign-out-alt"></i> 
                        <span class="d-none d-lg-inline">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .btn-custom {
        background-color: #007bff;
        color: white;
        border-radius: 30px;
        padding: 8px 20px;
        transition: all 0.3s ease;
        font-weight: bold;
    }

    .btn-custom:hover {
        background-color: #0056b3;
        color: #f1f1f1;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-custom-logout {
        background-color: #dc3545;
        color: white;
        border-radius: 30px;
        padding: 8px 20px;
        transition: all 0.3s ease;
        font-weight: bold;
    }

    .btn-custom-logout:hover {
        background-color: #c82333;
        color: #f1f1f1;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .fas {
        margin-right: 5px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .navbar-brand img {
            height: 50px; 
        }

        .btn-custom,
        .btn-custom-logout {
            padding: 6px 15px; 
            font-size: 0.9rem; 
        }
    }
</style>
