<?php
session_start();
include "../conn.php";
// Assuming user ID is stored in session after login
$userId = $_SESSION['id']; // Replace this with your method of getting the logged-in user's ID

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['currentPassword'];

    // Fetch the current user's password from the database
    $result = mysqli_query($conn, "SELECT password FROM users WHERE id = $userId");
    $user = mysqli_fetch_assoc($result);

    // Check if the current password is correct
    if (password_verify($currentPassword, $user['password'])) {
        echo 'correct'; // Return 'correct' if the password matches
    } else {
        echo 'incorrect'; // Return 'incorrect' if the password does not match
    }
}
?>
