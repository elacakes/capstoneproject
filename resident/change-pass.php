<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm" method="POST" action="reset-pass.php">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                        <div id="currentPasswordMessage" class="text-danger" style="display:none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        <div id="newPasswordMessage" class="text-danger" style="display:none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        <div id="confirmPasswordMessage" class="text-danger" style="display:none;"></div>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" id="showPasswords"> Show Password
                    </div>
                    <div class="text-success" id="success-message" style="display:none;"></div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Validate Current Password
    $('#currentPassword').on('input', function() {
        var currentPassword = $(this).val();
        $.ajax({
            url: 'check-pass.php',
            type: 'POST',
            data: { currentPassword: currentPassword },
            success: function(response) {
                var messageDiv = $('#currentPasswordMessage');
                if (response === 'correct') {
                    messageDiv.removeClass('text-danger').addClass('text-success');
                    messageDiv.text('Your current password is correct').show();
                } else {
                    messageDiv.removeClass('text-success').addClass('text-danger');
                    messageDiv.text('Your current password is incorrect').show();
                }
            }
        });
    });

    // Validate New Password and Confirm Password
    $('#newPassword, #confirmPassword').on('input', function() {
        var newPassword = $('#newPassword').val();
        var confirmPassword = $('#confirmPassword').val();
        var messageDiv = $('#confirmPasswordMessage');

        if (newPassword && confirmPassword) {
            if (newPassword === confirmPassword) {
                messageDiv.removeClass('text-danger').addClass('text-success');
                messageDiv.text('Passwords match').show();
            } else {
                messageDiv.removeClass('text-success').addClass('text-danger');
                messageDiv.text('Passwords did not match').show();
            }
        } else {
            messageDiv.hide(); 
        }
    });

    // Show/Hide Passwords
    $('#showPasswords').on('change', function() {
        var passwordFields = ['#currentPassword', '#newPassword', '#confirmPassword'];
        var inputType = this.checked ? 'text' : 'password';
        
        $(passwordFields.join(',')).attr('type', inputType);
    });
});
</script>
