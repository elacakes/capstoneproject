<?php
include "../conn.php";
include "includes/header.php";
?>
<div style="text-align: center; padding: 20px;">
    <img src="../img/puncan logo.png" alt="Barangay Puncan Logo" style="width: 100px; height: auto;">
    <h3 style="font-size: 24px;" class="mb-0">Barangay Puncan Certificate Issuance System</h3>
</div>
<div class="cards-container mt-0">
    <div class="card">
        <h4>Sign In</h4>
        <a class="btn" href="login.php">Access Account</a>
    </div>
    <div class="card">
        <h4>Sign Up</h4>
        <a class="btn" href="signup.php">Create Account</a>
    </div>
    <div class="card">
        <h4>About Us</h4>
        <a class="btn" href="about-us.php">Learn More</a>
    </div>
</div>
<br><br><br>
<?php
include "includes/footer.php";
?>