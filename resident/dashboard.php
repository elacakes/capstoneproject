<?php
include "../conn.php";
include "../assets/function.php";
include "includes/header.php";
include "includes/navbar.php";


?>
<section class="container mt-5">
    <div class="row">
        <div class="col-12 col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-file-earmark-text" style="font-size: 2rem; color: #007bff;"></i>
                    <h5 class="card-title mt-3">Request Certificate</h5>
                    <p class="card-text">Apply for a new barangay certificate easily.</p>
                    <a href="request.php" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestCert">Request Now</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-clock-history" style="font-size: 2rem; color: #28a745;"></i>
                    <h5 class="card-title mt-3">History</h5>
                    <p class="card-text">View your previous certificate requests.</p>
                    <a href="history.php" class="btn btn-success">View History</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-gear" style="font-size: 2rem; color: #ffc107;"></i>
                    <h5 class="card-title mt-3">Account Settings</h5>
                    <p class="card-text">Update your personal information.</p>
                    <a href="settings.php" class="btn btn-warning">Go to Settings</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Request Certificate -->

<?php
if (isset($_SESSION['status'])) {
    echo "<script>alert('" . $_SESSION['status'] . "');</script>";
    unset($_SESSION['status']); 
}
?>
<div class="modal fade" id="requestCert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="requestCertLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="requestCertLabel">Request Certificate</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="action.php" method="POST" class="needs-validation">
                    <div class="form-group mb-3">
                        <label for="certificate" class="form-label"><b>Select Certificate Type</b></label>
                        <select class="form-select" name="certificate" id="certificate" required>
                            <option hidden>--Please Select--</option>
                            <option value="clearance">Barangay Clearance</option>
                            <option value="indigency">Barangay Indigency</option>
                            <option value="residency">Barangay Residency</option>
                            <option value="birth_cert">Birth Certificate</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a certificate type.
                        </div>
                    </div>

                    <div class="form-floating mb-3 mt-2">
                        <input type="text" name="purpose" class="form-control" placeholder="Purpose" id="purpose" required>
                        <label for="purpose">Purpose</label>
                        <div class="invalid-feedback">
                            Please provide a purpose for the certificate request.
                        </div>
                    </div>

                    <div class="form-floating mb-3 mt-2">
                        <input type="datetime-local" name="pickup_datetime" class="form-control" placeholder="Pick-Up Date and Time" id="pickup_datetime" required>
                        <label for="pickup_datetime">Pick-Up Date and Time</label>
                        <div class="invalid-feedback">
                            Please select a valid date and time for pick-up.
                        </div>
                    </div>

                    <div class="form-group mb-3 text-center">
                        <button type="submit" name="send" class="btn btn-primary w-100 mb-1">Submit Request</button>
                        <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Cancel</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>