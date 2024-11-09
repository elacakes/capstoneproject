<?php
session_start();
include "../conn.php";
include "../assets/function.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "brgypuncan@gmail.com";
    $mail->Password = "jyvv bixb jjjl wlfz"; 
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("brgypuncan@gmail.com", "Barangay Puncan Certificate Issuance System");
    $mail->addAddress($email, $name);

    $mail->isHTML(true);
    $mail->Subject = 'Email Verification from Barangay Puncan';

    $email_template = "
    <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f7f7f7;
                    color: #333;
                }
                .container {
                    width: 90%;
                    max-width: 600px;
                    margin: auto;
                    background: white;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #007BFF;
                }
                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    margin: 20px 0;
                    color: white !important;
                    background-color: #007BFF !important;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 12px;
                    color: #888;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Welcome to Barangay Puncan Certificate Issuance System, " . htmlspecialchars($name) . "!</h2>
                <p>Thank you for signing up! To complete your registration, please click the button below to verify your email address.</p>
                <a href='192.168.137.1/certificateissuancesystem/verify_email.php?token=" . htmlspecialchars($verify_token) . "' class='button'>Verify Email Address</a>
                <div class='footer'>
                    <p>Kind regards,<br>Barangay Puncan, Carranglan Nueva Ecija</p>
                </div>
            </div>
        </body>
    </html>";

    $mail->Body = $email_template;

    try {
        $mail->send();
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


// SIGN UP FORM
if (isset($_POST['submit_user'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $age = validate($_POST['age']);
    $phone = validate($_POST['phone']);
    $bday = validate($_POST['bday']);
    $gender = validate($_POST['gender']);
    $status = validate($_POST['status']);
    $place = validate($_POST['place']);
    $stay = validate($_POST['stay']);
    $postal = validate($_POST['postal']);
    $zone = validate($_POST['zone']);
    $barangay = validate($_POST['barangay']);
    $municipality = validate($_POST['municipality']);
    $province = validate($_POST['province']);
    $mother_name = validate($_POST['mother_name']);
    $father_name = validate($_POST['father_name']);
    $pendingcase = validate($_POST['pendingcase']);
    $caseDetails = validate($_POST['caseDetails']);
    $verify_token = md5(rand()); 

    $sql = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $count_email = mysqli_num_rows($result);

    $role = 'resident';

    if ($count_email == 0) {
        $sql = "INSERT INTO users (name, email, password, age, phone, bday, gender, status, place, stay, postal, zone, barangay, municipality, province, mother_name, father_name, pendingcase, caseDetails, verify_token, role)
                VALUES ('$name', '$email', '$password', '$age', '$phone', '$bday', '$gender', '$status', '$place', '$stay', '$postal', '$zone', '$barangay', '$municipality', '$province', '$mother_name', '$father_name', '$pendingcase', '$caseDetails', '$verify_token', '$role')";

        if (mysqli_query($conn, $sql)) {
            $id = mysqli_insert_id($conn); 
            $_SESSION['id'] = $id;

            sendemail_verify($name, $email, $verify_token);

            $_SESSION['status'] = "We’ve sent a verification email. Please open it to activate your account.";
            header('Location: signup.php');
            exit(); 
        } else {
            $_SESSION['status'] = "Error: " . mysqli_error($conn); 
            header('Location: signup.php');
            exit();
        }
    } else {
        $_SESSION['status'] = "Email already exists!";
        header('Location: signup.php');
        exit();
    }
}




// LOGIN FORM

if (isset($_POST['login'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                if ($user['role'] === 'resident' && $user['verify_status'] != 1) {
                    $_SESSION['status']="Please verify your account first. Check your inbox!";
                    header('Location:login.php');
                } else {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['role'] = $user['role'];

                    if ($user['role'] === 'admin') {
                        header('Location: ../admin/dashboard.php');
                        exit();
                    } elseif ($user['role'] === 'resident') {
                        header('Location: ../resident/dashboard.php');
                        exit();
                    }
                }
            } else {
                $_SESSION['status']="Invalid email or password.";
                header('Location:login.php');
            }
        } else {
            $_SESSION['status']="User not found";
            header('Location:login.php');
        }
    } else {
        echo "Database query failed.";
    }
}

?>