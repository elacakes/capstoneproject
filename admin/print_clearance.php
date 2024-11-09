<?php
include '../conn.php';
include "../assets/function.php";

$source = isset($_GET['source']) ? $_GET['source'] : 'request'; 

$request_id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM certificate_requests WHERE id = '$request_id'");
$certificate = mysqli_fetch_assoc($sql);

if ($certificate) {
    $user_id = $certificate['user_id'];

    $result = mysqli_query($conn, "SELECT name, age, gender, status, bday, stay,zone FROM users WHERE id = '$user_id'");
    $test = mysqli_fetch_assoc($result);

    if ($result == TRUE) {
        $bday = $test['bday'];
        $formatted_bday = date("F j, Y", strtotime($bday));
        $name = $test['name'];
        $age = $test['age'];
        $gender = $test['gender'];
        $status = $test['status'];
        $stay = $test['stay'];
        $zone = $test['zone'];
    }
} else {
    $id = $_GET['id']; 
    $result = mysqli_query($conn, "SELECT name, age, gender, status, bday, stay, zone FROM users WHERE id = '$id'");
    $test = mysqli_fetch_assoc($result);

    if ($result == TRUE) {
        $bday = $test['bday'];
        $formatted_bday = date("F j, Y", strtotime($bday));
        $name = $test['name'];
        $age = $test['age'];
        $gender = $test['gender'];
        $status = $test['status'];
        $stay = $test['stay'];
        $zone = $test['zone'];
    }
}
?>

<!DOCTYPE html>
<html>
<title>Barangay Puncan Record System | Clearance</title>
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

    .specific-class {
      font-family: 'Bernard MT Condensed';
      font-size: 20px;
    }
  </style>
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



    <h1 align="center" style="font-family: Arial; text-transform: uppercase; margin-top: 40px; color: #2A4B7C; letter-spacing: 2px; font-size: 24px;"><u style="padding: 2px;">B</u><u style="padding: 2px;">A</u><u style="padding: 2px;">R</u><u style="padding: 2px;">A</u><u style="padding: 2px;">N</u><u style="padding: 2px;">G</u><u style="padding: 2px;">A</u><u style="padding: 2px;">Y</u> <u style="padding: 2px;">C</u><u style="padding: 2px;">L</u><u style="padding: 2px;">E</u><u style="padding: 2px;">A</u><u style="padding: 2px;">R</u><u style="padding: 2px;">A</u><u style="padding: 2px;">N</u><u style="padding: 2px;">C</u><u style="padding: 2px;">E</u></h1>

    <p style="margin-left: 10%; margin-top: 40px; font-family: 'Comic Neue';font-style: italic;"><b>TO WHOM IT MAY CONCERN:</b></p>

    <p align="justify" style="margin-left: 10%; margin-right: 10%; line-height: 1.5; text-indent: 50px; font-family: 'Comic Neue';font-style: italic;">
      <b>This is to certify that</b><span style="text-decoration:underline;"> &nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $name; ?></b> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>.<br>
      Aged:<span style="text-decoration: underline;"> &nbsp; <b><?php echo $age ?></b> Years Old &nbsp;</span> &nbsp;Born On: <u> &nbsp; <b><?php echo $formatted_bday; ?></b> </u> &nbsp; Status: <b><u>&nbsp;<?php echo $status; ?> </u></b> &nbsp; is a resident of this barangay since year <u> &nbsp; <b><?php echo $stay; ?> </b></u> ,
      with exact mailing address at <u> &nbsp; <b><?php echo $zone; ?></b> &nbsp;</u>,Barangay Puncan, Carranglan, Nueva Ecija .
    </p>

    <p align="justify" style="margin-left: 10%; margin-right: 10%; line-height: 1.5; text-indent: 50px;font-family: 'Comic Neue';font-style:italic;">
      <b style="font-family: 'Comic Neue';font-style:italic;font-weight: 600;">He/She</b> has found no deregatory record or any pending case filed against him/her as per implementation of Katarungang Pambarangay is concern.
    </p>

    <p align="justify" style="margin-left: 10%; margin-right: 10%; line-height: 1.5; text-indent: 50px;font-family: 'Comic Neue';font-style:italic;">
    This <b style="font-family: 'Comic Neue';font-style:italic;font-weight: 600;">BARANGAY CLEARANCE</b> is issued upon his/her request for 
    <b><u>
        <?php
        if ($request_id && $certificate) {
            $select2 = mysqli_query($conn, "SELECT purpose FROM certificate_requests WHERE id='$request_id'");
            $row2 = mysqli_fetch_assoc($select2);
            echo $row2['purpose'];
        } else {
            echo "<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>";
        }
        ?>
    </u></b> purpose/s. Issued this <u> &nbsp; <b><?php echo date('jS'); ?>, of <?php echo date('F'); ?> ,</b></u>&nbsp;2024, here at the Office of the
    Punong Barangay at Barangay Puncan, Carranglan, Nueva Ecija.
</p>

    <div style="display: flex; align-items: flex-start; justify-content: center; margin-top: 90px;">
    <div style="text-align: center; margin-right: 10px;margin-left:90px;">
        <p style="text-transform: uppercase; margin: 0; font-family: 'Cambria', serif; padding-left: 20px; padding-right: 20px;">
            <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
                echo $name;
            ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
        </p>
        <b style="font-size: 0.8rem;">[Requester's Signature Above Printed Name]</b>
    </div>

    <div style="width: 1in; height: 1in; border: 1px solid black; position: relative;margin-left:50px;margin-top:-50px;">
        <p style="color: red; font-size: xx-small; margin: 0; padding: 0; position: absolute; bottom: 5px; left: 2px;">
            RIGHT THUMB MARK
        </p>
    </div>
</div>
<br><br><br><br><br>
    <div style="text-align: center; margin-right: 325px;">
      <p style="text-transform: uppercase; margin: 0; font-family: 'Cambria', serif; display: inline-block; padding-left: 20px; padding-right: 20px;">
        <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
                                                            $select2 = mysqli_query($conn, "SELECT fullname FROM officials WHERE position = 'Barangay Captain'");
                                                            $row2 = mysqli_fetch_assoc($select2);
                                                            echo $row2['fullname'];
                                                            ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
      </p>
      <p style="margin: 0; font-family: 'Cambria', serif; font-weight: bold;font-size:15px;">
        Punong Barangay/LnB President
      </p>
    </div>
    <br><br><br>
    <p style="margin-bottom: 20px; margin-left:50%; font-size:small;">THIS IS NOT VALID IF WITHOUT BRGY. DRY SEAL</p>
    <br><br>
  </div>
</body>
<center>
  <input type="button" name="submit" onclick="window.print()" value="PRINT"><br><br>
  <a href="<?php echo $source == 'walkin' ? 'resident.php' : 'certificate.php'; ?>" class="btn btn-secondary">
    Back
</a></center><br>
<?php
        $update_sql = "UPDATE certificate_requests SET status = 'Released' WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
    ?>

</html>