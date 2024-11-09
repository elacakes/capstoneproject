<?php
include "../conn.php";
include "includes/header.php";
include "../assets/function.php";
?>

<div class="container about-us my-5">
  <div>
    <a href="index.php" class="btn btn-light">
      <i class="fas fa-arrow-left" style="transform: rotate -(180deg);"></i> 
    </a>
  </div>
  <h1 class="text-center mb-4" style="font-size: 1.8rem;">About Us</h1>
  <h3 class="text-center mb-4" style="font-size: 1.3rem;">Your Gateway to Efficient Barangay Services</h3>
  
  <div class="row">
    <div class="col-md-6 text-justify">
      <p style="font-size: 0.8rem;">
        The Barangay Puncan Certificate Issuance System is designed to simplify the process of requesting and managing barangay certificates. Our platform aims to provide residents with a seamless experience while facilitating efficient operations for barangay administrators.
      </p>
      
      <h4 style="font-size: 1rem;">Key Features:</h4>
      <ul style="font-size: 0.8rem;">
        <li>Resident Dashboard: A user-friendly interface for managing personal information.</li>
        <li>Online Certificate Requests: Effortlessly request various certificates from the comfort of your home.</li>
        <li>Admin Panel: Comprehensive tools for administrators to handle requests and issue certificates efficiently.</li>
        <li>Real-time Notifications: Receive timely updates via email about the status of your requests.</li>
        <li>Walk-in Transactions: Options for residents to make requests in person at the barangay hall.</li>
      </ul>
    </div>
    <div class="col-md-6">
      <img src="../img/hall.jpeg" alt="Barangay Certificate System" class="img-fluid rounded shadow" style="width:95%; height:85%;"/>
    </div>
  </div>
</div>
<br>
<?php include "includes/footer.php"; ?>
