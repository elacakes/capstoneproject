<?php
session_start();
include "../conn.php";
include "../assets/function.php";

$user_id = $_SESSION['id'];

if (isset($_POST['update_info'])) {
    $name = validate($_POST['name']);
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

    $query_update = "UPDATE users SET 
                    name = '$name',
                    age = '$age',
                    phone = '$phone',
                    bday = '$bday',
                    gender = '$gender',
                    status = '$status',
                    place = '$place',
                    stay = '$stay',
                    postal = '$postal',
                    zone = '$zone',
                    barangay = '$barangay',
                    municipality = '$municipality',
                    province = '$province',
                    mother_name = '$mother_name',
                    father_name = '$father_name',
                    pendingcase = '$pendingcase',
                    caseDetails = '$caseDetails'
                    WHERE id = $user_id";

    if (mysqli_query($conn, $query_update)) {
        $_SESSION['status'] = "Updated successfully!";
        header('Location:settings.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


// REQUEST CERTIFICATE
$user_id = $_SESSION['id'];

if (isset($_POST['send'])) {
    $user_id = $_SESSION['id']; 
    $certificateType = $_POST['certificate'];
    $purpose = $_POST['purpose'];
    $pickupDatetime = $_POST['pickup_datetime'];

    $sql = "INSERT INTO certificate_requests (user_id, certificate_type, purpose, pickup_datetime) 
            VALUES ('$user_id', '$certificateType', '$purpose', '$pickupDatetime')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['status']= "Request Sent Successfully!";
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

