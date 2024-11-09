<?php
include "../conn.php";
include "includes/header.php";
include "includes/sidebar.php";
include "../assets/function.php";
?>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="col-md-10">
    <nav class="navbar">
        <h4>Certificate Issuance System</h4>
    </nav>
    <h4 class="text-center">Barangay Residents</h4>

    <button type="button" class="btn btn-outline-dark" title="Click to add new" data-bs-toggle="modal" data-bs-target="#createdata">
        <i class="bi bi-person-plus-fill"></i> Resident
    </button>
    <div class="container content-wrapper">

        <?php include "view_resident_modal.php"; ?>

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


        <!-- display -->
        <div class="card-body">
            <table id="residentsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fetch_query = "SELECT id, name FROM users WHERE role='resident'";
                    $fetch_query_run = mysqli_query($conn, $fetch_query);

                    if (mysqli_num_rows($fetch_query_run) > 0) {
                        while ($row = mysqli_fetch_array($fetch_query_run)) {
                    ?>
                            <tr>
                                <td class="user_id"><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm view_data" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-success btn-sm edit_data" title="Edit Details">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" title="Print Certificate" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class='bi bi-printer' style=' transition: color 0.3s;'></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="print_clearance.php?id=<?php echo $row['id']; ?>&source=walkin">Barangay Clearance</a></li>
                                            <li><a class="dropdown-item" href="print_indigency.php?id=<?php echo $row['id']; ?>&source=walkin">Barangay Indigency</a></li>
                                            <li><a class="dropdown-item" href="print_residency.php?id=<?php echo $row['id']; ?>&source=walkin">Barangay Residency</a></li>
                                            <li><a class="dropdown-item" href="print_birth_cert.php?id=<?php echo $row['id']; ?>&source=walkin">Barangay Birth Certification</a></li>
                                        </ul>
                                    </div>
                                    <button class="btn btn-warning btn-sm" title="Change Password" data-bs-toggle="modal" data-bs-target="#changePasswordModal" onclick="loadUserPasswordForm(<?php echo $row['id']; ?>)">
                                        <i class="bi bi-key-fill"></i>
                                    </button>
                                    <a href="#" class="btn btn-danger btn-sm fs-10" title="Delete Admin Details"
                                        data-id="<?php echo $row['id']; ?>"
                                        onclick="confirmDelete(this);">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>

                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="3">NO record found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php include "edit_resident_modal.php"; ?>

    </div>

</div>
<?php include "add_resident_modal.php"; ?>


<?php include "change-pass.php"; ?>



<?php include "includes/footer.php"; ?>
<script>


    // data tables
    $(document).ready(function() {
        $('#residentsTable').DataTable({
            "searching": true,
            "paging": true,
            "info": true,
            "lengthChange": true,
            "pageLength": 5,
            "lengthMenu": [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100]
            ],
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


    // view script
    $(document).on('click', '.view_data', function(e) {
    e.preventDefault();
    var user_id = $(this).closest('tr').find('.user_id').text();

    $.ajax({
        type: "POST",
        url: "action.php",
        data: {
            'click_view': true,
            'user_id': user_id,
        },
        success: function(response) {
            $('.view_user_data').html(response);
            $('#viewusermodal').modal('show');
        }
    });
});

    // edit script
    $(document).ready(function() {
        $('.edit_data').click(function(e) {
            e.preventDefault();

            // console.log('hello');

            var user_id = $(this).closest('tr').find('.user_id').text();
            console.log(user_id);

            $.ajax({
                type: "POST",
                url: "action.php",
                data: {
                    'click_edit': true,
                    'user_id': user_id,
                },
                success: function(response) {
                    // console.log(response);



                    $.each(response, function(Key, value) {
                        //  console.log(value['name']); 

                        $("#user_id").val(value['id']);
                        $("#name").val(value['name']);
                        $("#email").val(value['email']);
                        $("#age").val(value['age']);
                        $("#phone").val(value['phone']);
                        $("#bday").val(value['bday']);
                        $(".gender").val(value['gender']);
                        $(".status").val(value['status']);
                        $("#place").val(value['place']);
                        $("#stay").val(value['stay']);
                        $("#postal").val(value['postal']);
                        $("#zone").val(value['zone']);
                        $("#barangay").val(value['barangay']);
                        $("#municipality").val(value['municipality']);
                        $("#province").val(value['province']);
                        $("#mother_name").val(value['mother_name']);
                        $("#father_name").val(value['father_name']);
                        $("#pendingcase").val(value['pendingcase']);
                        $("#caseDetails").val(value['caseDetails']);

                    });

                    $('#editdata').modal('show');

                }
            });
        });
    });

    // confirm delete
    let deleteId;

    function confirmDelete(element) {
        deleteId = element.getAttribute('data-id');
        $('#deleteConfirmModal').modal('show');
    }

    $('#confirmDeleteButton').on('click', function() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'delete_resident.php';
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = 'id';
        hiddenField.value = deleteId;
        form.appendChild(hiddenField);
        document.body.appendChild(form);
        form.submit();
    });
</script>