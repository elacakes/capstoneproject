<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../pages/login.php');
    exit();
}

if ($_SESSION['role'] == 'admin') {
    header('Location: ../pages/login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/main.css">
    <link rel="stylesheet" href="style/resident.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="icon" type="image/png" href="../img/puncan logo.png">
    <title>Resident Dashboard</title>
</head>
<?php include "../session.php"; ?>
<body>