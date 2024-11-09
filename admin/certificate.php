<?php
include "../conn.php";
include "includes/header.php";
include "includes/sidebar.php";
include "../assets/function.php";

if (isset($_SESSION['status'])) {
    echo "<script>alert('" . $_SESSION['status'] . "');</script>";
    unset($_SESSION['status']);
}
?>

<div class="col-md-10">
    <nav class="navbar">
        <h4>Certificate Issuance System</h4>
    </nav>
    <h4 class="text-center">Certificate Requests</h4>
    <div class="container content-wrapper">
        <ul class="nav nav-tabs mb-2" id="certificateTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="false">Pending</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button" role="tab" aria-controls="approved" aria-selected="false">Approved</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="denied-tab" data-bs-toggle="tab" data-bs-target="#denied" type="button" role="tab" aria-controls="denied" aria-selected="false">Denied</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">Released</button>
            </li>
        </ul>

        <div class="tab-content" id="certificateTabContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <table id="allCertificates" class="display">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Certificate Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_all = "SELECT cr.*, u.name FROM certificate_requests cr JOIN users u ON cr.user_id = u.id";
                        $result_all = $conn->query($sql_all);
                        while ($row = $result_all->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['certificate_type']) . "</td>";
                            echo "<td class='d-flex gap-1'>";

                            echo "<button class='btn btn-link p-0' title='View' data-bs-toggle='modal' data-bs-target='#viewModal' onclick='loadResidentInfo(" . $row['id'] . ")'><i class='bi bi-eye' style='font-size: 1.5rem; color: blue; transition: color 0.3s;'></i></button>";

                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>


            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <table id="pendingCertificatesTable" class="display">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Certificate Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_pending = "SELECT cr.*, u.name FROM certificate_requests cr JOIN users u ON cr.user_id = u.id WHERE cr.status = 'Pending'";
                        $result_pending = $conn->query($sql_pending);
                        while ($row = $result_pending->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['certificate_type']) . "</td>";
                            echo "<td class='d-flex gap-1'>";

                            echo "<button class='btn btn-link p-0' title='View' data-bs-toggle='modal' data-bs-target='#viewModal' onclick='loadResidentInfo(" . $row['id'] . ")'><i class='bi bi-eye' style='font-size: 1.5rem; color: blue; transition: color 0.3s;'></i></button>";

                            $print_buttons = [
                                'clearance' => 'print_clearance.php',
                                'indigency' => 'print_indigency.php',
                                'residency' => 'print_residency.php',
                                'birth_cert' => 'print_birth_cert.php'
                            ];

                            if ($row['status'] === 'Approved' && array_key_exists($row['certificate_type'], $print_buttons)) {
                                echo "<a href='" . $print_buttons[$row['certificate_type']] . "?id=" . $row['id'] . "' class='btn btn-link p-0' title='Print " . ucfirst($row['certificate_type']) . "'><i class='bi bi-printer' style='font-size: 1.5rem; color: blue; transition: color 0.3s;'></i></a>";
                            }

                            if ($row['status'] === 'Pending') {
                                echo "<form action='action.php' method='POST' class='d-inline'>";
                                echo "<input type='hidden' name='request_id' value='" . $row["id"] . "'>";
                                echo "<button type='submit' name='action' value='approve' class='btn btn-link p-0' title='Approve'><i class='bi bi-check-circle' style='font-size: 1.5rem; color: green; transition: color 0.3s;'></i></button>";
                                echo "<button type='button'  value='decline' class='btn btn-link p-0' title='Decline' onclick='openDeclineModal(" . $row['id'] . ")'><i class='bi bi-x-circle' style='font-size: 1.5rem; color: red; transition: color 0.3s;'></i></button>";
                                echo "</form>";
                            }

                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Decline Reason Modal -->
            <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="declineForm" action="action.php" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title" id="declineModalLabel">Decline Request</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="request_id" id="declineRequestId">
                                <div class="mb-3">
                                    <label for="declineReason" class="form-label">Reason for Decline</label>
                                    <textarea class="form-control" id="declineReason" name="decline_reason" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="action" value="decline" class="btn btn-danger">Decline</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                <table id="approvedCertificates" class="display" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Certificate Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_approved = "SELECT cr.*, u.name FROM certificate_requests cr JOIN users u ON cr.user_id = u.id WHERE cr.status = 'Approved'";
                        $result_approved = $conn->query($sql_approved);
                        while ($row = $result_approved->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['certificate_type']) . "</td>";
                            echo "<td class='d-flex gap-1'>";

                            echo "<button class='btn btn-link p-0' title='View' data-bs-toggle='modal' data-bs-target='#viewModal' onclick='loadResidentInfo(" . $row['id'] . ")'><i class='bi bi-eye' style='font-size: 1.5rem; color: blue; transition: color 0.3s;'></i></button>";

                            $print_buttons = [
                                'clearance' => 'print_clearance.php',
                                'indigency' => 'print_indigency.php',
                                'residency' => 'print_residency.php',
                                'birth_cert' => 'print_birth_cert.php'
                            ];

                            if ($row['status'] === 'Approved' && array_key_exists($row['certificate_type'], $print_buttons)) {
                                echo "<a href='" . $print_buttons[$row['certificate_type']] . "?id=" . $row['id'] . "' class='btn btn-link p-0' title='Print " . ucfirst($row['certificate_type']) . "'><i class='bi bi-printer' style='font-size: 1.5rem; color: blue; transition: color 0.3s;'></i></a>";
                            }

                            if ($row['status'] === 'Pending') {
                                echo "<form action='action.php' method='POST' class='d-inline'>";
                                echo "<input type='hidden' name='request_id' value='" . $row["id"] . "'>";
                                echo "<button type='submit' name='action' value='approve' class='btn btn-link p-0' title='Approve'><i class='bi bi-check-circle' style='font-size: 1.5rem; color: green; transition: color 0.3s;'></i></button>";
                                echo "<button type='submit' name='action' value='decline' class='btn btn-link p-0' title='Decline'><i class='bi bi-x-circle' style='font-size: 1.5rem; color: red; transition: color 0.3s;'></i></button>";
                                echo "</form>";
                            }

                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="denied" role="tabpanel" aria-labelledby="denied-tab">
                <table id="deniedCertificates" class="display" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Certificate Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_denied = "SELECT cr.*, u.name FROM certificate_requests cr JOIN users u ON cr.user_id = u.id WHERE cr.status = 'Declined'";
                        $result_denied = $conn->query($sql_denied);
                        while ($row = $result_denied->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['certificate_type']) . "</td>";
                            echo "<td class='d-flex gap-1'>";

                            echo "<button class='btn btn-link p-0' title='View' data-bs-toggle='modal' data-bs-target='#viewModal' onclick='loadResidentInfo(" . $row['id'] . ")'><i class='bi bi-eye' style='font-size: 1.5rem; color: blue; transition: color 0.3s;'></i></button>";

                            $print_buttons = [
                                'clearance' => 'print_clearance.php',
                                'indigency' => 'print_indigency.php',
                                'residency' => 'print_residency.php',
                                'birth_cert' => 'print_birth_cert.php'
                            ];

                            if ($row['status'] === 'Approved' && array_key_exists($row['certificate_type'], $print_buttons)) {
                                echo "<a href='" . $print_buttons[$row['certificate_type']] . "?id=" . $row['id'] . "' class='btn btn-link p-0' title='Print " . ucfirst($row['certificate_type']) . "'><i class='bi bi-printer' style='font-size: 1.5rem; color: blue; transition: color 0.3s;'></i></a>";
                            }

                            if ($row['status'] === 'Pending') {
                                echo "<form action='action.php' method='POST' class='d-inline'>";
                                echo "<input type='hidden' name='request_id' value='" . $row["id"] . "'>";
                                echo "<button type='submit' name='action' value='approve' class='btn btn-link p-0' title='Approve'><i class='bi bi-check-circle' style='font-size: 1.5rem; color: green; transition: color 0.3s;'></i></button>";
                                echo "<button type='button' value='decline' class='btn btn-link p-0' title='Decline' onclick='openDeclineModal(" . $row['id'] . ")'><i class='bi bi-x-circle' style='font-size: 1.5rem; color: red; transition: color 0.3s;'></i></button>";
                                echo "</form>";
                            }

                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>


            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                <table id="completedCertificates" class="display" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Certificate Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_completed = "SELECT cr.*, u.name FROM certificate_requests cr JOIN users u ON cr.user_id = u.id WHERE cr.status = 'Released'";
                        $result_completed = $conn->query($sql_completed);
                        while ($row = $result_completed->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['certificate_type']) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Resident Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="residentInfoContent"></div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>

<script>
// for the textbox
function openDeclineModal(requestId) {
    document.getElementById("declineRequestId").value = requestId;
    var declineModal = new bootstrap.Modal(document.getElementById('declineModal'));
    declineModal.show();
}


    // calling the tab from dashboard
    document.addEventListener("DOMContentLoaded", function() {
        const hash = window.location.hash;
        if (hash) {
            const tabButton = document.querySelector(`button[data-bs-target="${hash}"]`);
            if (tabButton) {
                new bootstrap.Tab(tabButton).show();
            }
        }
    });


    // all tab
    $(document).ready(function() {
        $('#allCertificates').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            pageLength: 5,
            lengthMenu: [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100]
            ],

        });
    });

    // pending tab
    $(document).ready(function() {
        $('#pendingCertificatesTable').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            pageLength: 5,
            lengthMenu: [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100]
            ],

        });
    });

    // approved tab
    $(document).ready(function() {
        $('#approvedCertificates').DataTable({
            "paging": true,
            "searching": true,
            "lengthChange": true,
            "info": true,
            "pageLength": 5,
            "lengthMenu": [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100]
            ],
        });
    });

    // denied tab
    $(document).ready(function() {
        $('#deniedCertificates').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            info: true,
            pageLength: 5,
            lengthMenu: [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100]
            ],
        });
    });

    // release tab
    $(document).ready(function() {
        $('#completedCertificates').DataTable({
            paging: true,
            searching: true,
            lengthChange: true,
            info: true,
            pageLength: 5,
            lengthMenu: [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100]
            ],
        });
    });



    function loadResidentInfo(requestId) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_resident_info.php?id=' + requestId, true);
        xhr.onload = function() {
            if (this.status === 200) {
                document.getElementById('residentInfoContent').innerHTML = this.responseText;
            } else {
                document.getElementById('residentInfoContent').innerHTML = 'No information found!';
            }
        };
        xhr.send();
    }
</script>