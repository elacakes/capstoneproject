<?php
session_start();
include "../conn.php";
// Assuming user ID is stored in session after login
$userId = $_SESSION['id']; // Replace this with your method of getting the logged-in user's ID

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Initialize an array for error messages
    $errors = [];

    // Fetch the current user's password from the database
    $result = mysqli_query($conn, "SELECT password FROM users WHERE id = $userId");
    $user = mysqli_fetch_assoc($result);

    // Check if current password matches
    if (!password_verify($currentPassword, $user['password'])) {
        $errors[] = "Current password is incorrect.";
    }

    // Check if new password is provided and meets criteria
    if (empty($newPassword)) {
        $errors[] = "New password cannot be empty.";
    } elseif (strlen($newPassword) < 8) {
        $errors[] = "New password must be at least 8 characters long.";
    }

    // Check if new password matches the confirm password
    if ($newPassword !== $confirmPassword) {
        $errors[] = "New password and confirm password do not match.";
    }

    // If there are no errors, update the password
    if (empty($errors)) {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $updateResult = mysqli_query($conn, "UPDATE users SET password = '$hashedPassword' WHERE id = $userId");

        if ($updateResult) {
            header("Location: ../logout.php?message=Password changed successfully, please log in again.");
            exit();
        } else {
            $errors[] = "Error updating password. Please try again.";
        }
    }

    // Store error messages in session
    if (!empty($errors)) {
        $_SESSION['error_messages'] = $errors;
    }

    // Redirect back to the dashboard
    header("Location: settings.php");
    exit();
}
?>
