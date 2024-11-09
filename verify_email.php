<?php
session_start();
include "conn.php";
include "assets/function.php";

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $verify_query = "SELECT verify_token, verify_status FROM users WHERE verify_token = '$token' LIMIT 1";
    $verify_query_run = mysqli_query($conn, $verify_query);

    if (mysqli_num_rows($verify_query_run) > 0) {
        $row = mysqli_fetch_array($verify_query_run);

        if ($row['verify_status'] == "0") {
            $clicked_token = $row['verify_token'];
            $update_query = "UPDATE users SET verify_status = '1' WHERE verify_token = '$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($conn, $update_query);

            if ($update_query_run) {
                echo '<script>
            alert("Verification success! You can now log in to your account.");
            window.location.href = "pages/login.php";
            </script>';
            } else {
                $_SESSION['registerStatus'] = "Verification Failed!";
                header('Location: pages/signup.php');
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Email already verified.";
            header('Location: pages/login.php');
            exit(0);
        }
    } else {
        $_SESSION['status'] = "This token does not exist.";
        header('Location: pages/login.php');
        exit(0);
    }
} else {
    $_SESSION['status'] = "Not Allowed";
    header('Location: pages/login.php');
    exit(0);
}
