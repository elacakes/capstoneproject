<?php
include "../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id']; 
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password='$new_password' WHERE id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo '<script>
        alert("Password updated");
                window.location.href="resident.php";
        </script>';
    } else {
        echo "Error updating password: " . $conn->error;
    }
}
?>


<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Change User Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="changePasswordForm" method="POST" action="">
          <input type="hidden" name="user_id" id="userId">
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="newPassword" name="new_password" placeholder="New Password" required oninput="validatePasswordLength()">
            <label for="newPassword" class="form-label">New Password</label>
            <small id="passwordFeedback" class="form-text"></small>
          </div>
          <button type="submit" class="btn btn-primary" onclick="return validatePassword()">Change Password</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    function loadUserPasswordForm(userId) {
        document.getElementById('userId').value = userId;
    }

    function validatePasswordLength() {
        const password = document.getElementById('newPassword').value; 
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
        const password = document.getElementById('newPassword').value; 
        const minLength = 8;

        if (password.length < minLength) {
            alert("Password must be at least 8 characters long.");
            return false; 
        }
        return true; 
    }
</script>
