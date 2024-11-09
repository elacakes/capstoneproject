<?php
include '../conn.php';
include "../assets/function.php";

$source = isset($_GET['source']) ? $_GET['source'] : 'request';

$request_id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM certificate_requests WHERE id = '$request_id'");
$certificate = mysqli_fetch_assoc($sql);

if ($certificate) {
    $user_id = $certificate['user_id'];

    $result = mysqli_query($conn, "SELECT name, bday,barangay,municipality,province, mother_name, father_name FROM users WHERE id = '$user_id'");
    $test = mysqli_fetch_assoc($result);

    if ($result == TRUE) {
        $bday = $test['bday'];
        $formatted_bday = date("F j, Y", strtotime($bday));
        $name = $test['name'];
        $mother_name = $test['mother_name'];
        $father_name = $test['father_name'];
        $test = [
            'barangay' => 'Puncan',
            'municipality' => 'Carranglan',
            'province' => 'Nueva Ecija'
        ];
        $birthplace = $test['barangay'] . ', ' . $test['municipality'] . ', ' . $test['province'];
    }
} else {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT name, age, gender, status, bday,mother_name,father_name, zone FROM users WHERE id = '$id'");
    $test = mysqli_fetch_assoc($result);

    if ($result == TRUE) {
        $bday = $test['bday'];
        $formatted_bday = date("F j, Y", strtotime($bday));
        $name = $test['name'];
        $mother_name = $test['mother_name'];
        $father_name = $test['father_name'];
        $test = [
            'barangay' => 'Puncan',
            'municipality' => 'Carranglan',
            'province' => 'Nueva Ecija'
        ];
        $birthplace = $test['barangay'] . ', ' . $test['municipality'] . ', ' . $test['province'];
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
            background-image: url('../img/logo2.png');
            background-size: 500px;
            background-position: center;
            background-repeat: no-repeat;
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

        <h1 align="center" style="font-family: Arial; text-transform: uppercase; margin-top: 20px; color: #1A4D33; font-size: 20px;">
            <u>B</u>
            <u>I</u>
            <u>R</u>
            <u>T</u>
            <u>H</u>
            &nbsp;
            <u>C</u>
            <u>E</u>
            <u>R</u>
            <u>T</u>
            <u>I</u>
            <u>F</u>
            <u>I</u>
            <u>C</u>
            <u>A</u>
            <u>T</u>
            <u>I</u>
            <u>O</u>
            <u>N</u>
            &nbsp;
            <u>F</u>
            <u>R</u>
            <u>O</u>
            <u>M</u>
            &nbsp;
            <u>B</u>
            <u>A</u>
            <u>R</u>
            <u>A</u>
            <u>N</u>
            <u>G</u>
            <u>A</u>
            <u>Y</u>
        </h1>

        <p style="margin-left: 10%; margin-top: 40px; font-family: 'Comic Neue';font-weight: 600;font-style: normal;">TO WHOM IT MAY CONCERN:</p>

        <p align="justify" style="margin-left: 8%; margin-right: 10%; line-height: 1.5; text-indent: 50px; font-family: 'Comic Neue', cursive; font-weight:600; font-style:italic;">
            <b>This is to certify that:</b> <br>
        </p>

        <p align="justify" style="margin-left: 8%; margin-right: 10%; line-height: 1.5; text-indent: 50px;">
            NAME :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $name; ?> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></u> <br>
        </p>
        <p align="justify" style="margin-left: 8%; margin-right: 10%; line-height: 1.5; text-indent: 50px;">
            DATE OF BIRTH : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $formatted_bday; ?> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></b></span> <br>
        </p>
        <p align="justify" style="margin-left: 8%; margin-right: 10%; line-height: 1.5; text-indent: 50px;text-transform:uppercase;">
            PLACE OF BIRTH: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><b><?php echo $birthplace; ?></b></u></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
        </p>
        <p align="justify" style="margin-left: 8%; margin-right: 10%; line-height: 1.5; text-indent: 50px; font-family: 'Comic Neue', cursive; font-weight:600; font-style:italic;">
            Is a son/daughter of:
        </p>
        <p align="justify" style="margin-left: 8%; margin-right: 10%; line-height: 1.5; text-indent: 50px;">
            NAME OF FATHER :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $father_name; ?> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></u> <br>
        </p>
        <p align="justify" style="margin-left: 8%; margin-right: 10%; line-height: 1.5; text-indent: 50px;">
            NAME OF MOTHER :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $mother_name; ?> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></u> <br>
        </p>

        <p align="justify" style="margin-left: 10%; margin-right: 10%; line-height: 1.5; text-indent: 50px;font-family: 'Times New Roman';">
            <b style="font-family: 'Comic Neue', cursive;font-style:italic;">This certification</b> is issued upon the request of <u><b><?php echo $mother_name; ?></b></u> , and may only be use specifically for the purpose of Birth Registration of the
            above child's name at the Office of the Municipal Civil Registrar of Carranglan, issued here at Barangay Puncan, Carranglan, Nueva Ecija, this <u> &nbsp; <b><?php echo date('F'); ?> <?php echo date('j'); ?>, </b><b><?php echo date('Y'); ?></b></u>.
        </p>
        <div style="text-align: center;">
            <br><br>
            <p style=" margin: 0;padding-left: 20px; padding-right: 20px;">
                <center><i>Prepared and Verified:</i></center>
            </p>
        </div>

        <br><br>
        <hr style="text-align:end;margin-right:70px;width: 30%;">
        <div style="text-align:end;margin-right:70px;">
            <p style="text-transform: uppercase; margin: 0; font-family: 'Cambria', serif; display: inline-block; padding-left: 20px; padding-right: 20px;">
                &nbsp;&nbsp;&nbsp;<?php
                                    $select2 = mysqli_query($conn, "SELECT fullname FROM officials WHERE is_signatory= 'active' AND position = 'Barangay Secretary'");
                                    $row2 = mysqli_fetch_assoc($select2);
                                    echo $row2['fullname'];
                                    ?>
            </p>
            <p style="margin: 0;font-size:15px;">
                Barangay Secretary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </p>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Certified and Approved:</i>

        <br><br><br><br>
        <div style="text-align: center; margin-right: 350px;">
            <p style="text-transform: uppercase; margin: 0; font-family: 'Cambria', serif; display: inline-block; padding-left: 20px; padding-right: 20px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
                                                                $select2 = mysqli_query($conn, "SELECT fullname FROM officials WHERE position = 'Barangay Captain'");
                                                                $row2 = mysqli_fetch_assoc($select2);
                                                                echo $row2['fullname'];
                                                                ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </p>
            <p style="margin: 0; font-family: 'Cambria', serif; font-weight: bold;font-size:15px;">
                Punong Barangay/LnB President
            </p>
        </div>
        <br>
        <p style="margin-bottom: 20px; margin-left:70%; font-size:small;font-family: 'Comic Neue';color:blue;"><b>BRGY. DRY SEAL</b></p>

    </div>
</body>
<center>
    <input type="button" name="submit" onclick="window.print()" value="PRINT"><br><br>

    <a href="<?php echo $source == 'walkin' ? 'resident.php' : 'certificate.php'; ?>" class="btn btn-secondary">Back</a>
</center><br>

<?php
$update_sql = "UPDATE certificate_requests SET status = 'Released' WHERE id = ?";
$stmt = $conn->prepare($update_sql);
$stmt->bind_param("i", $request_id);
$stmt->execute();
?>

</html>