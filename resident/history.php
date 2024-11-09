<?php
include "../conn.php";
include "../assets/function.php";
include "includes/header.php";
include "includes/navbar.php";

$user_id = $_SESSION['id'];

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT * FROM certificate_requests WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

?>

<a href="dashboard.php" class="btn mb-3" style="background-color: #a7c6ed; border-color: #a7c6ed;">
    <i class="bi bi-arrow-left-circle-fill" style="font-size: 1.2rem; color: #0056b3;"></i> Dashboard
</a>

<div class="container">
    <h3 class="mb-4 text-primary">Your Certificate History</h3>
    
    <table id="certificateTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Certificate Type</th>
                <th>Purpose</th>
                <th>Pickup</th>
                <th>Reason of Decline Request</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['certificate_type']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['purpose']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['pickup_datetime']) . '</td>'; 
                    echo '<td>' . htmlspecialchars($row['decline_reason']) . '</td>'; 
                    echo '<td><span class="badge bg-' . ($row['status'] == 'Completed' ? 'success' : ($row['status'] == 'Pending' ? 'warning' : 'danger')) . '">' . htmlspecialchars($row['status']) . '</span></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="4" class="text-danger text-center">No certificate requests found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#certificateTable').DataTable({
            "searching": true, 
            "paging": true,    
            "info": true,      
            "lengthChange": true,
            "pageLength": 5,   
            "lengthMenu": [[5,10,25,50,100], [5,10,25,50,100]],
            "language": {
                "lengthMenu": "Show _MENU_ entries",
                "zeroRecords": "No matching records found",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "No entries available",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "search": "Search:"
            }
        });
    });
</script>

<?php include "includes/footer.php"; ?>
