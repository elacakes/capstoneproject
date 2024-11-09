<?php
include '../conn.php';
include "../assets/function.php";

$source = isset($_GET['source']) ? $_GET['source'] : 'request'; 

$request_id = $_GET['id'];  // Assuming you are passing the certificate request ID via GET
$sql = mysqli_query($conn, "SELECT * FROM certificate_requests WHERE id = '$request_id'");
$certificate = mysqli_fetch_assoc($sql);

if ($certificate) {
    // Get the user ID from the certificate request
    $user_id = $certificate['user_id'];

    // Now query the user's information based on the user ID
    $result = mysqli_query($conn, "SELECT name, age,stay, status, bday,postal, zone FROM users WHERE id = '$user_id'");
    $test = mysqli_fetch_assoc($result);

    if ($result == TRUE) {
        $bday = $test['bday'];
        $formatted_bday = date("F j, Y", strtotime($bday));
        $name = $test['name'];
        $age = $test['age'];
        $stay = $test['stay'];
        $status = $test['status'];
        $postal = $test['postal'];
        $zone = $test['zone'];
    }
} else {
    // If there's no certificate request, you might need to get user info directly from the users table
    $id = $_GET['id'];  // Assuming you're passing the user ID directly if there's no certificate request
    $result = mysqli_query($conn, "SELECT name, age,stay, status, bday,postal, zone FROM users WHERE id = '$id'");
    $test = mysqli_fetch_assoc($result);

    if ($result == TRUE) {
        $bday = $test['bday'];
        $formatted_bday = date("F j, Y", strtotime($bday));
        $name = $test['name'];
        $age = $test['age'];
        $stay = $test['stay'];
        $status = $test['status'];
        $postal = $test['postal'];
        $zone = $test['zone'];
    }
}
?>

<!DOCTYPE html>
<html>
<link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">

<head>
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        .div {
            width: 7.5in;
            height: 10in;
            margin: .5in auto;

        }

        input[type=button] {
            width: 100px;
            padding: 12px;
            border: none;
            background-color: #AED6F1;
            font-family: sans-serif;
        }

        input[type=button]:hover {
            background-color: #2E86C1;
            color: white;
            transition: .5s;
        }

        a {
            background-color: #C39BD3;
            color: black;
            text-decoration: none;
            padding-top: 9px;
            padding-bottom: 9px;
            padding-left: 28px;
            padding-right: 28px;
            font-family: sans-serif;
        }

        a:hover {
            background-color: #6C3483;
            color: white;
            transition: .5s;
        }
    </style>
    <title>Barangay Puncan Record System | Clearance</title>

</head>

<body>
    <div class="div">
    <img src="../img/puncan logo.png" width="100px" style="position: absolute; margin-top: -10px; margin-left: 100px;">

<p align="center" style="font-size: 16px; margin: 0;">
  <b style="font-family: 'Brush script mt', cursive;">Republic of the Philippines</b><br>
  <b style="font-family: 'Berlin', bold;">Province of Nueva Ecija</b><br>
  Municipality of Carranglan<br>
  <b class="specific-class">BARANGAY PUNCAN</b><br>
</p>

<!-- Added Contact Number directly below the heading -->
<p align="center" style="font-size: 16px; margin: 0;">
  <small>Contact Number:
    <?php
    $select2 = mysqli_query($conn, "SELECT phone FROM users WHERE role='admin'");
    $row2 = mysqli_fetch_assoc($select2);
    echo $row2['phone'];
    ?>
  </small>
</p>
<h1 align="center" style="font-family: 'Times New Roman'; text-transform: uppercase; letter-spacing: 1px; font-size: 24px; color: red; margin: 0;">Office of the Punong Barangay</h1>

<hr style="width: 80%; margin: 0 auto;">

        <h1 align="center" style="font-family: Arial; text-transform: uppercase; margin-top: 40px; color: #003366; letter-spacing: 2px; font-size: 24px;"><u style="padding: 2px;">c</u><u style="padding: 2px;">e</u><u style="padding: 2px;">r</u><u style="padding: 2px;">t</u><u style="padding: 2px;">i</u><u style="padding: 2px;">f</u><u style="padding: 2px;">i</u><u style="padding: 2px;">c</u><u style="padding: 2px;">a</u><u style="padding: 2px;">t</u><u style="padding: 2px;">e</u> <text style="text-transform:lowercase;">of</text> <u style="padding: 2px;">r</u><u style="padding: 2px;">e</u><u style="padding: 2px;">s</u><u style="padding: 2px;">i</u><u style="padding: 2px;">d</u><u style="padding: 2px;">e</u><u style="padding: 2px;">n</u><u style="padding: 2px;">c</u><u style="padding: 2px;">y</u></h1>

        <p style="margin-left: 10%; margin-top: 40px; font-family: 'Comic Neue';font-weight: 600;font-style: normal;">TO WHOM IT MAY CONCERN:</p>

        <p align="justify" style="margin-left: 10%; margin-right: 10%; line-height: 1.5; text-indent: 50px; font-family: 'Comic Neue', cursive; font-weight:600; font-style:italic;">
            This is to certify that the person named below is a resident of this barangay since year <span style="text-decoration:underline;"> &nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $stay; ?>&nbsp;&nbsp;&nbsp;</b></span>. <br>
        </p>

        <p align="justify" style="margin-left: 8%; margin-right: 10%; line-height: 1.5; text-indent: 50px;">
            NAME:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $name; ?> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></u> <br>
        </p>
        <p align="justify" style="margin-left: 8%; margin-right: 10%; line-height: 1.5; text-indent: 50px;">
            AGE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>&nbsp;&nbsp;&nbsp;<?php echo $age; ?> &nbsp;&nbsp;&nbsp; </u></b></span>YEARS OLD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CIVIL STATUS: <span style="text-decoration:underline;"> &nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $status; ?> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span><br>
        </p>
        <p align="justify" style="margin-left: 8%; margin-right: 10%; line-height: 1.5; text-indent: 50px;">
            DATE OF BIRTH: <b><u>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $formatted_bday; ?> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b></span> <br>
        </p>
        <p align="justify" style="margin-left: 8%; margin-right: 10%; line-height: 1.5; text-indent: 50px;">
            POSTAL ADDRESS: <span style="text-decoration:underline;"> &nbsp;&nbsp;&nbsp;&nbsp; <b><?php echo $postal; ?>,&nbsp; <?php echo $zone; ?> &nbsp; &nbsp;</b></span>Puncan, Carranglan Nueva Ecija.<br>
        </p>
        

        <p align="justify" style="margin-left: 10%; margin-right: 10%; line-height: 1.5; text-indent: 50px; font-family: 'Comic Neue',cursive;font-weight: 600;font-style: italic;">
            This Certificate of Residency is issued upon his/her request, this <u> &nbsp; <?php echo date('jS');?></u>,day  of <u><?php echo date('F'); ?> ,</u>&nbsp;2024.
            Here at Barangay of Puncan, Carranglan, Nueva Ecija.
        </p>
        <br><br><br><br><br>
        <div style="text-align: right; margin-right:5rem;">
        <p style="margin-left:60%;">
       <u style="text-transform:uppercase;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
                    $select2 = mysqli_query($conn, "SELECT fullname FROM officials WHERE is_signatory= 'active' AND position = 'Barangay Captain'");
                    $row2 = mysqli_fetch_assoc($select2);
                    echo $row2['fullname'];
                    ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br>
        <b style="font-family:'Comic Neue';">Punong Barangay/LnB President</b>
        </div>
    </div>
</body>
<center>
        <input type="button" name="submit" onclick="window.print()" value="PRINT"><br><br>

        <a href="<?php echo $source == 'walkin' ? 'resident.php' : 'certificate.php'; ?>" class="btn btn-secondary">Back</a></center><br>

    <?php
        $update_sql = "UPDATE certificate_requests SET status = 'Released' WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
    ?>
</html>