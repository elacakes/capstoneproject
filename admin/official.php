<?php
include "../conn.php";
include "includes/header.php";
include "includes/sidebar.php";
include "../assets/function.php";

$currentDate = date('Y-m-d');
$updateStatusQuery = "UPDATE officials SET status = 'End Term' WHERE term_end < '$currentDate' AND status = 'Active'";
mysqli_query($conn, $updateStatusQuery);
?>

<div class="col-md-10">
    <nav class="navbar">
        <h4>Certificate Issuance System</h4>
    </nav>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <h4 class="text-center">Barangay Official</h4>
    <button type="button" class="btn btn-outline-dark" title="Click to add new" data-bs-toggle="modal" data-bs-target="#insertdata"><i class="bi bi-person-plus-fill"></i> Add Official</button>
    <div class="container content-wrapper">
        <!--INSERT DATA-->
        <div class="modal fade" id="insertdata" tabindex="-1" aria-labelledby="insertdataLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="insertdataLabel">Manage Officials</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="action.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="position" class="form-label">Position</label>
                                <select name="position" id="position" class="form-select">
                                    <option hidden>-- Select Positions --</option>
                                    <option value="Barangay Captain">Barangay Captain</option>
                                    <option value="Barangay Councilor">Barangay Councilor</option>
                                    <option value="Barangay Secretary">Barangay Secretary</option>
                                    <option value="Barangay Treasurer">Barangay Treasurer</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="contact" class="form-label">Contact #</label>
                                <input type="number" id="contact" name="contact" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="termStart" class="form-label">Start Term</label>
                                <input type="date" id="termStart" name="term_start" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="termEnd" class="form-label">End Term</label>
                                <input type="date" id="termEnd" name="term_end" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="insertOfficial" class="btn btn-primary">Save Info</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- INSERT MODAL -->

        <!-- view modal-->
        <div class="modal fade" id="viewusermodal" tabindex="-1" aria-labelledby="viewusermodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="viewusermodalLabel">Official Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="view_user_data">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- view modal-->

        <!-- delete modal -->
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this official?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>


        <!-- edit modal -->
        <div class="modal fade" id="editdata" tabindex="-1" aria-labelledby="editdataLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editdataLabel">Manage Officials</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="action.php" method="POST">
                            <div class="form-group">
                                <input type="hidden" id="user_id" name="id" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" name="fullname" id="fullname" class="form-control fullname" placeholder="Enter name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="position" class="form-label">Position</label>
                                <select name="position" id="position" class="form-select position">
                                    <option hidden>-- Select Position --</option>
                                    <option value="Barangay Captain">Barangay Captain</option>
                                    <option value="Barangay Councilor">Barangay Councilor</option>
                                    <option value="Barangay Secretary">Barangay Secretary</option>
                                    <option value="Barangay Treasurer">Barangay Treasurer</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="contact" class="form-label">Contact #</label>
                                <input type="number" id="contact" name="contact" class="form-control contact">
                            </div>
                            <div class="form-group mb-3">
                                <label for="term_start" class="form-label">Start Term</label>
                                <input type="date" id="term_start" name="term_start" class="form-control term_start">
                            </div>
                            <div class="form-group mb-3">
                                <label for="term-end" class="form-label">End Term</label>
                                <input type="date" id="term-end" name="term_end" class="form-control term_end">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="update_data" class="btn btn-primary">Save Info</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .bi-pencil-square:hover {
                color: #007bff;
                transform: scale(1.1);
                transition: transform 0.3s, color 0.3s;
            }
        </style>
        <!-- edit modal -->

        <!-- Display data -->
        <div class="card-body">
    <table id="officialsTable" class="table table-bordered table-striped table-primary table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Position</th>
                <th>Full Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="showData">
            <?php
            $sql = "SELECT id, fullname, position, status FROM officials";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td class="user_id"><?php echo $row['id']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['status'] == 'End Term' ? 'End Term' : 'Active'; ?></td>
                    <td>
                        <a href="#" class="btn btn-success btn-sm fs-10 edit_data" title="Edit Details"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-primary btn-sm fs-10 view_data" title="View Details"><i class="fas fa-eye"></i></a>

                        <a href="#" class="btn btn-danger btn-sm fs-10" title="Delete Details"
                            data-id="<?php echo $row['id']; ?>"
                            onclick="confirmDelete(this);">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>




        <!-- Display data -->
    </div>
</div>


<?php include "includes/footer.php"; ?>

<script>
// data table
$(document).ready(function() {
        $('#officialsTable').DataTable({
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

    // view details
    $(document).ready(function() {

        $('.view_data').click(function(e) {
            e.preventDefault();

            var user_id = $(this).closest('tr').find('.user_id').text();
            /*console.log(user_id);*/

            $.ajax({
                method: "POST",
                url: "action.php",
                data: {
                    'click_view_btn': true,
                    'user_id': user_id,
                },
                success: function(response) {


                    $('.view_user_data').html(response);
                    $('#viewusermodal').modal('show');
                }
            });

        });
    });
    // view details

    // edit data
    $(document).ready(function() {

        $('.edit_data').click(function(e) {
            e.preventDefault();

            var user_id = $(this).closest('tr').find('.user_id').text();
            console.log(user_id);

            $.ajax({
                method: "POST",
                url: "action.php",
                data: {
                    'click_edit_btn': true,
                    'user_id': user_id,
                },
                success: function(response) {
                    // console.log(response);

                    $.each(response, function(Key, value) {

                        // console.log(value['fullname']);
                        $('#user_id').val(value['id']);
                        $('.fullname').val(value['fullname']);
                        $('.contact').val(value['contact']);
                        $('.position').val(value['position']);
                        $('.term_start').val(value['term_start']);
                        $('.term_end').val(value['term_end']);

                    });

                    $('#editdata').modal('show');
                }
            });

        });
    });
    // edit data

    // confirm delete
    let deleteId;

function confirmDelete(element) {
    deleteId = element.getAttribute('data-id'); 
    $('#deleteConfirmModal').modal('show');
}

$('#confirmDeleteButton').on('click', function() {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'delete_official.php';
    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'id';
    hiddenField.value = deleteId; 
    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
});

</script>