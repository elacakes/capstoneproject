<?php
session_start();
include "../conn.php";
include "includes/header.php";
include "../assets/function.php";
?>
<div class="container"  style="margin-bottom:10rem;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div>
            </div>
            <div class="p-4 shadow position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 mt-2 me-2" aria-label="Close" onclick="window.location.href='login.php';"></button>
                <h3 class="fw-bold text-center">Forgot Password</h3>
                <?php alertMessage('green');?>
                <form action="../password_reset.php" method="POST">
                    <div>
                        <p class="text-muted mb-0">Enter your email address below and we will send you a password reset email.</p>
                    </div>
                    <div class="form-floating mb-3 mt-1">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <label for="email">Email <sup>*</sup></label>
                    </div>
                    <div class="mb-2 text-center">
                        <button type="submit" name="password_reset" class="btn btn-primary w-100 fw-bold">Submit</button>
                    </div>
                </form>
                <div class="text-center">
                    <a href="login.php" class="btn btn-secondary w-100 fw-bold">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>