<?php
include "../conn.php";
include "includes/header.php";
include "includes/sidebar.php";
include "../assets/function.php";
?>
<div class="col-md-10">
    <nav class="navbar">
        <h4>Certificate Issuance System</h4>
    </nav>
    <div class="container content-wrapper mt-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <a href="resident.php" class="text-decoration-none">
                    <div class="dashboard-card shadow text-center p-4">
                        <i class="bi bi-people-fill display-4 text-primary mb-3"></i>
                        <h5 class="font-weight-bold">
                            <?php
                            $query = "SELECT COUNT(*) as total FROM users WHERE role='resident'";
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo $row['total'];
                            } else {
                                echo "Error: " . mysqli_error($conn);
                            }
                            ?>
                        </h5>
                        <h5>Total Residents</h5>
                    </div>
                </a>
            </div>

            <!-- Printed Certificates Card -->
            <div class="col-md-6 mb-4">
                <a href="certificate.php#completed" class="text-decoration-none">
                    <div class="dashboard-card shadow text-center p-4" title="Released Certificates">
                        <i class="bi bi-file-earmark-check-fill display-4 text-success mb-3"></i>
                        <h5 class="font-weight-bold">
                            <?php
                            $query = "SELECT COUNT(*) as total FROM certificate_requests WHERE status='Released'";
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo $row['total'];
                            } else {
                                echo "Error: " . mysqli_error($conn);
                            }
                            ?>
                        </h5>
                        <h5>Released Certificates</h5>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Pending Requests Card -->
            <div class="col-md-6 mb-4">
                <a href="certificate.php#pending" class="text-decoration-none">
                    <div class="dashboard-card shadow text-center p-4">
                        <i class="bi bi-hourglass-split display-4 text-warning mb-3"></i>
                        <h5 class="font-weight-bold">
                            <?php
                            $query = "SELECT COUNT(*) as total FROM certificate_requests WHERE status='Pending'";
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo $row['total'];
                            } else {
                                echo "Error: " . mysqli_error($conn);
                            }
                            ?>
                        </h5>
                        <h5>Pending Requests</h5>
                    </div>
                </a>
            </div>


            <!-- Declined Requests Card -->
            <div class="col-md-6 mb-4">
                <a href="certificate.php#denied" class="text-decoration-none">
                    <div class="dashboard-card shadow text-center p-4">
                        <i class="bi bi-file-earmark-x-fill display-4 text-danger mb-3"></i>
                        <h5 class="font-weight-bold">
                            <?php
                            $query = "SELECT COUNT(*) as total FROM certificate_requests WHERE status='Declined'";
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                echo $row['total'];
                            } else {
                                echo "Error: " . mysqli_error($conn);
                            }
                            ?>
                        </h5>
                        <h5>Declined Requests</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>