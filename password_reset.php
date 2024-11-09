<?php 
session_start();
include "conn.php";
include "assets/function.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function send_password_reset($get_name, $get_email, $token)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "brgypuncan@gmail.com";
    $mail->Password   = "jyvv bixb jjjl wlfz"; 
    
    $mail->SMTPSecure = "tls"; 
    $mail->Port       = 587;

    $mail->setFrom("brgypuncan@gmail.com", "Barangay Puncan");
    $mail->addAddress($get_email);       
    
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Request';

    $email_template = "
    <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #eaeaea; border-radius: 5px; background-color: #f9f9f9;'>
        <h2 style='color: #333;'>Password Reset Request</h2>
        <p>Hello,</p>
        <p>We received a request to reset your password. If you made this request, please click the button below:</p>
        <a href='192.168.137.1/certificateissuancesystem/password_change.php?token=$token&email=$get_email' 
           style='display: inline-block; padding: 10px 15px; font-size: 16px; color: white; background-color: #ff0000; border-radius: 5px; text-decoration: none;'> 
           Reset Password 
        </a>
        <p>If you didn't request this, you can ignore this email.</p>
        <p>Thank you,<br>Barangay Puncan</p>
    </div>
    ";

    $mail->Body = $email_template;

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Password reset email sent successfully.';
    }
}


// password reset
if(isset($_POST['password_reset']))
{
    $email = mysqli_escape_string($conn,$_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($check_email_run) > 0)
    {
        $row = mysqli_fetch_array($check_email_run );
        $get_name = $row['name'];
        $get_email = $row ['email'];

        $update_token = "UPDATE users SET verify_token= '$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($conn, $update_token);

        if($update_token_run)
        {
            send_password_reset($get_name,$get_email,$token);
            $_SESSION['status'] = "We've sent a password reset link to your email. Please check your inbox.";
            header('Location:pages/forgot_pass.php');
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Something went wrong! #1";
            header('Location: pages/forgot_pass.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "No email found.";
        header('Location: pages/forgot_pass.php');
        exit(0);
    }
}
// password reset

// password update

if (isset($_POST['pass_update'])) {
    $email = mysqli_escape_string($conn, $_POST['email']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);
    $token = mysqli_real_escape_string($conn, $_POST['password_token']);

    if (!empty($token)) {
        if (!empty($new_password) && !empty($c_password)) {
            $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1";
            $check_token_run = mysqli_query($conn, $check_token);

            if (mysqli_num_rows($check_token_run) > 0) {
                if ($new_password === $c_password) {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                    $update_password = "UPDATE users SET password='$hashed_password' WHERE verify_token='$token' LIMIT 1";
                    $update_password_run = mysqli_query($conn, $update_password);

                    if ($update_password_run) {
                        echo '<script>
                        alert("Password updated successfully!");
                        window.location.href="pages/login.php";
                      </script>';
                      exit(0);
                    } else {
                        $_SESSION['status'] = "Did not change password. Something went wrong.";
                        header("Location: password_change.php?token=$token&email=$email");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "Password and Confirm Password do not match.";
                    header("Location: password_change.php?token=$token&email=$email");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid Token.";
                header("Location: password_change.php?token=$token&email=$email");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "All fields are mandatory.";
            header("Location: password_change.php?token=$token&email=$email");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No token available.";
        header('Location: password_change.php');
        exit(0);
    }
}

?>