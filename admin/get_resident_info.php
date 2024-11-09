<?php
include "../conn.php";
include "../assets/function.php";

if (isset($_GET['id'])) {
    $request_id = $_GET['id'];
    if (isset($_GET['id'])) {
        $request_id = $_GET['id'];  

        $sql = "SELECT cr.*, u.name, u.email,u.age, u.phone, u.bday, u.gender,u.place,u.stay,u.postal,u.zone,u.barangay, u.status AS civil_status, 
                        u.municipality, u.province, u.mother_name, u.father_name, 
                       u.pendingcase, u.caseDetails 
                FROM certificate_requests cr
                JOIN users u ON cr.user_id = u.id
                WHERE cr.id = $request_id"; 

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $resident_info = $result->fetch_assoc();
        }
?>
        <div class="container mt-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-text"><strong>Name:</strong> <?php echo htmlspecialchars($resident_info['name']); ?></p>
                            <p class="card-text"><strong>Certificate Type:</strong> <?php echo htmlspecialchars($resident_info['certificate_type']); ?></p>
                            <p class="card-text"><strong>Purpose:</strong> <?php echo htmlspecialchars($resident_info['purpose']); ?></p>
                            <p class="card-text"><strong>Pickup Date and Time:</strong> <?php echo htmlspecialchars($resident_info['pickup_datetime']); ?></p>
                            <p class="card-text"><strong>Status of Request:</strong> <?php echo htmlspecialchars($resident_info['status']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="card-text"><strong>Email Address:</strong> <?php echo htmlspecialchars($resident_info['email']); ?></p>
                            <p class="card-text"><strong>Pending Case:</strong> <?php echo htmlspecialchars($resident_info['pendingcase']); ?></p>
                            <p class="card-text"><strong>Case Details:</strong> <?php echo htmlspecialchars($resident_info['caseDetails']); ?></p><br>
                            <p class="card-text"><strong>Reason for Decline Request:</strong> <?php echo htmlspecialchars($resident_info['decline_reason']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "<div class='alert alert-warning'>No record found!</div>";
    }
} else {
    echo "<div class='alert alert-danger'>No ID provided!</div>";
}
?>