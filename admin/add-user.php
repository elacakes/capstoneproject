<?php
include "../conn.php";
include "../assets/function.php";
include "includes/header.php";
include "includes/sidebar.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="col-md-10">
    <nav class="navbar">
        <h4>Certificate Issuance System</h4>
    </nav>
    <h4 class="text-center">Add Administrator</h4>
    <button type="button" class="btn btn-outline-dark" title="Click to add new" data-bs-toggle="modal" data-bs-target="#addUser"><i class="bi bi-person-plus-fill"></i> Admin</button>
    <div class="container content-wrapper">
        <!-- ADDING ADMINISTRATORS -->
        <div class="modal fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addUserLabel">Add new admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div>
                        <p class="text-muted mb-0">&nbsp;&nbsp;&nbsp;Enter new details below.</p>
                    </div>
                    <div class="modal-body">
                        <form action="action.php" method="POST">
                            <div class="form-floating mb-2">
                                <input type="text" name="name" id="name" title="Insert Admin Name" class="form-control" required placeholder="Name">
                                <label for="name" class="form-label">Name <sup class="text-danger">*</sup></label>

                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" name="phone" id="phone" class="form-control" required placeholder="Contact Number">
                                <label for="phone" class="form-label">Contact Number<sup class="text-danger">*</sup></label>

                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" name="email" id="email" class="form-control" required placeholder="Email Address">
                                <label for="email" class="form-label">Email Address <sup class="text-danger">*</sup></label>

                            </div>
                            <div class="form-floating mb-2">
                                <input type="password" name="password" id="password" class="form-control" required placeholder="Password" required oninput="validatePasswordLength()">
                                <label for="password" class="form-label">Password <sup class="text-danger">*</sup></label>
                                <small id="passwordFeedback" class="form-text"></small>

                            </div>
                            <div class="text-center d-grid gap-2 mt-3 mb-3">
                                <button type="submit" name="user" class="btn btn-primary" onclick="return validatePassword()">Add User</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- edit -->
        <div class="modal fade" id="editAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editAdminLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editAdminLabel">Update admin details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div>
                        <p class="text-muted mb-0">&nbsp;&nbsp;&nbsp;Edit details below.</p>
                    </div>
                    <div class="modal-body">
                        <form action="action.php" method="POST">
                            <div class="form-floating mb-2">
                                <input type="hidden" name="id" class="form-control" id="user_id">
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" name="name" id="name" class="form-control name" placeholder="Name">
                                <label for="name" class="form-label">Name </label>

                            </div>
                            <div class="form-floating mb-2">
                                <input type="number" name="phone" id="phone" class="form-control phone" placeholder="Contact Number">
                                <label for="phone" class="form-label">Phone</label>

                            </div>
                            <div class="form-floating mb-2">
                                <input type="email" name="email" id="email" class="form-control email" placeholder="Email Address">
                                <label for="email" class="form-label">Email Address </label>

                            </div>
                            <div class="form-floating mb-2">
                                <input type="password" name="password" id="password" class="form-control password" placeholder="Password">
                                <label for="password" class="form-label">Password </label>

                            </div>
                            <div class="text-center d-grid gap-2 mt-3 mb-3">
                                <button type="submit" name="update_admin" class="btn btn-primary">Update Admin</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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


        <!-- view  -->
        <div class="modal fade" id="showAdmin" tabindex="-1" aria-labelledby="showAdminLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="showAdminLabel">Admin Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="view_admin_data">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- dispklay -->
        <div class="container">
            <h2>Admin List</h2>
            <table id="adminTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM users WHERE role = 'admin'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td class="user_id"> <?php echo htmlspecialchars($row['id']); ?> </td>
                                <td> <?php echo htmlspecialchars($row['name']); ?> </td>
                                <td> <?php echo htmlspecialchars($row['phone']); ?> </td>
                                <td> <?php echo htmlspecialchars($row['email']); ?> </td>
                                <td>
                                    <a href="#" class='btn btn-primary btn-sm admin_view' title="View Admin Details"><i class="fas fa-eye"></i></a>
                                    <a href="#" class='btn btn-success btn-sm admin_edit' title="Edit Admin Details"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm fs-10" title="Delete Admin Details" data-id="<?php echo $row['id']; ?>" onclick="confirmDelete(this);"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No admins found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

</div>
<?php include "includes/footer.php"; ?>

<script>
    // data tables
    $(document).ready(function() {
        $('#adminTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "pageLength": 5,
            "lengthMenu": [5, 10, 25, 50, 100]
        });
    });


    // view script
    $(document).ready(function() {
        $('.admin_view').click(function(e) {
            e.preventDefault();

            var user_id = $(this).closest('tr').find('.user_id').text();

            $.ajax({
                type: "POST",
                url: "action.php",
                data: {
                    'click_view_admin': true,
                    'user_id': user_id,
                },
                success: function(response) {
                    $('.view_admin_data').html(response);
                    $('#showAdmin').modal('show');
                }
            });
        });
    });

    // edit script
    $(document).ready(function() {
        $('.admin_edit').click(function(e) {
            e.preventDefault();

            // console.log('hello');

            var user_id = $(this).closest('tr').find('.user_id').text();
            console.log(user_id);

            $.ajax({
                type: "POST",
                url: "action.php",
                data: {
                    'click_edit_admin': true,
                    'user_id': user_id,
                },
                success: function(response) {
                    // console.log(response);



                    $.each(response, function(Key, value) {
                        //  console.log(value['name']); 

                        $("#user_id").val(value['id']);
                        $(".name").val(value['name']);
                        $(".phone").val(value['phone']);
                        $(".email").val(value['email']);
                    });

                    $('#editAdmin').modal('show');

                }
            });
        });
    });

    // password 
    function validatePasswordLength() {
        const password = document.getElementById('password').value;
        const feedback = document.getElementById('passwordFeedback');

        if (password.length < 8) {
            feedback.textContent = "Password must contain at least 8 characters.";
            feedback.style.color = "red";
        } else {
            feedback.textContent = "Password looks good!";
            feedback.style.color = "green";
        }
    }

    function validatePassword() {
        const password = document.getElementById('password').value;
        const minLength = 8;

        if (password.length < minLength) {
            alert("Password must be at least 8 characters long.");
            return false;
        }
        return true;
    }

    // confirm delete
    let deleteId;

    function confirmDelete(element) {
        deleteId = element.getAttribute('data-id');
        $('#deleteConfirmModal').modal('show');
    }

    $('#confirmDeleteButton').on('click', function() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'delete_admin.php';
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = 'id';
        hiddenField.value = deleteId;
        form.appendChild(hiddenField);
        document.body.appendChild(form);
        form.submit();
    });
</script>