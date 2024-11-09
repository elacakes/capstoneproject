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
    $result = mysqli_query($conn, "SELECT name, age, gender, status, bday, stay, postal, zone FROM users WHERE id = '$user_id'");
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
    // If there's no certificate request, you might need to get user info directly from the users table
    $id = $_GET['id'];  // Assuming you're passing the user ID directly if there's no certificate request
    $result = mysqli_query($conn, "SELECT name, age, gender, status, bday, stay, postal, zone FROM users WHERE id = '$id'");
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
<link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
<title>Barangay Puncan Record System | Clearance</title>

<head>
  <style>
    body{
      padding: 0;
      margin: 0;
    }

    .div{
      width: 7.5in;
      height: 10in;
      margin: .5in auto;
      background-image: url('images/puncan logo2.png');
      background-size: 500px;
      background-position: center;
      background-repeat: no-repeat;

    }

    input[type=button]{
      width: 100px;
      padding: 12px;
      border: none;
      background-color: #AED6F1;
      font-family: sans-serif;
    }
    input[type=button]:hover{
      background-color: #2E86C1;
      color: white;
      transition: .5s;
    }
    a{
      background-color: #C39BD3;
      color: black;
      text-decoration: none;
      padding-top: 9px;
      padding-bottom: 9px;
      padding-left: 28px;
      padding-right: 28px;
      font-family: sans-serif;
    }

    a:hover{
      background-color: #6C3483;
      color: white;
      transition: .5s;
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
    
    <h1 align="center" style="font-family: Arial; text-transform: uppercase; margin-top: 20px; color:  #1A4D33; letter-spacing: 2px; font-size: 22px;"><u style="padding: 2px;">B</u><u style="padding: 2px;">A</u><u style="padding: 2px;">R</u><u style="padding: 2px;">A</u><u style="padding: 2px;">N</u><u style="padding: 2px;">G</u><u style="padding: 2px;">A</u><u style="padding: 2px;">Y</u>   <u style="padding: 2px;">I</u><u style="padding: 2px;">N</u><u style="padding: 2px;">D</u><u style="padding: 2px;">I</u><u style="padding: 2px;">G</u><u style="padding: 2px;">E</u><u style="padding: 2px;">N</u><u style="padding: 2px;">C</u><u style="padding: 2px;">Y</u> <u style="padding: 2px;">C</u><u style="padding: 2px;">E</u><u style="padding: 2px;">R</u><u style="padding: 2px;">T</u><u style="padding: 2px;">I</u><u style="padding: 2px;">F</u><u style="padding: 2px;">I</u><u style="padding: 2px;">C</u><u style="padding: 2px;">A</u><u style="padding: 2px;">T</u><u style="padding: 2px;">E</u></h1>

    <p style="margin-left: 10%; margin-top: 35px; font-family: 'Comic Neue';font-style: italic;"><b>TO WHOM IT MAY CONCERN:</b></p>

    <p align="justify" style="margin-left: 10%; margin-right: 10%; line-height: 1.5; text-indent: 50px;font-family:'Comic Neue';font-style:italic;font-size:15px;">
    This is to certify that the person named below, is in the level of poverty and suffered real hardship to source out income and lacking in the comforts of life. He/She is one among <b>indigent constituent</b> of Barangay Puncan.</p>
    <p align="justify" style="margin-left: 5%; margin-right: 10%; line-height: 1.5; text-indent: 50px;">
    <u>NAME:</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="text-transform:uppercase;"><?php echo $name?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br></p>
    <p align="justify" style="margin-left: 5%; margin-right: 10%; line-height: 1.5; text-indent: 50px;">
    <u>AGE:</u>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-decoration:underline;">         &nbsp;&nbsp;&nbsp;<b><?php echo $age; ?> &nbsp;&nbsp;&nbsp;</b></span> Yrs. Old       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <u>BIRTHDAY:</u> <span style="text-decoration:underline;"> &nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $formatted_bday; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <p align="justify" style="margin-left: 5%; margin-right: 10%; line-height: 1.5; text-indent: 50px;">
    <u>GENDER:</u> &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox">Male <input type="checkbox">Female &nbsp;&nbsp;&nbsp;&nbsp;<u>STATUS:</u> <input type="checkbox">Single <input type="checkbox">Married <input type="checkbox">Widow/er
    <p align="justify" style="margin-left: 5%; margin-right: 10%; line-height: 1.5; text-indent: 50px;">
    <u>ADDRESS:</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="font-family:'Comic Neue';font-size: 15px;"><b><?php echo $zone; ?></b></i>&nbsp;&nbsp;</u>, <i style="font-family:'Comic Neue';font-size: 15px;">Puncan,Carranglan, Nueva Ecija.</i>
    <br>
    <p align="justify" style="margin-left: 10%; margin-right: 10%; line-height: 1.5; text-indent: 50px;font-family:'Comic Neue';font-size: 15px;">
      <i>As per attach document herewith, this <b>Certificate of Indigence</b> is requested for the purpose of seeking:</i><br>
    <p align="justify" style="margin-left: 2%; margin-right: 10%; line-height: 1.5; text-indent: 50px;font-size: 15px;">
      <u style="font-size: 15px;">Type of Assistance Needed:</u><b><input type="checkbox">Medical <input type="checkbox">Financial <input type="checkbox">Educational <input type="checkbox">Legal <input type="checkbox">Burial </b><br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>For submission to the office of:</u>&nbsp;&nbsp;&nbsp;<input type="checkbox">LGU/DSWD/Municipality of Carranglan <br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox">DSWD/Province of Nueva Ecija/National <br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox">Office of 2<sup>nd</sup> District Representative<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox">Other: <span style="text-decoration:underline"></span> <br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Issued upon request of:
      <center><p style="text-transform: uppercase; margin: 0; font-family: 'Cambria', serif; display: inline-block; padding-left: 20px; padding-right: 20px;">
        <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
           
            echo $name;
        ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
    </p></center>
    <center><b style="font-size:0.8rem;">[Requester's Signature Above Printed Name]</b></center>
    <br><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Issued:<u> &nbsp; <?php echo date('jS');?>, of <?php echo date('F');?> ,</u>&nbsp;<b><?php echo date('Y');?></b>
    <p style="margin-left:60%;">
       <u style="text-transform:uppercase;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
                    $select2 = mysqli_query($conn, "SELECT fullname FROM officials WHERE is_signatory= 'active' AND position = 'Barangay Captain'");
                    $row2 = mysqli_fetch_assoc($select2);
                    echo $row2['fullname'];
                    ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br>
        <b style="font-family:'Comic Neue';">Punong Barangay/LnB President</b>
        <p style="margin-left:10%; font-size:small;color:blue;"><b>Not Valid if Without Barangay Dry Seal</b></p>
    </div>
</div>
    </div>
</body>
<center>
  <input type="button" name="submit" onclick="window.print()" value="PRINT"><br><br>

  <a href="<?php echo $source == 'walkin' ? 'resident.php' : 'certificate.php'; ?>" class="btn btn-secondary">Back</a><br>
</center>
<?php
        $update_sql = "UPDATE certificate_requests SET status = 'Released' WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
    ?>
</html>