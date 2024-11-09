<?php
include "../conn.php";
include "../assets/function.php";

// insert ADMINISTRATOR

if (isset($_POST['user'])) {

    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $role = 'admin';

    $sql = "INSERT INTO users (name, phone, email, password, role) VALUES ('$name', '$phone', '$email', '$hashed_password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('New admin added successfully');
        window.location.href='add-user.php';
      </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// view admin
if (isset($_POST['click_view_admin'])) {
    $id = $_POST['user_id'];

    $fetch_query = "SELECT * FROM users WHERE id='$id' AND role = 'admin'";
    $fetch_query_run = mysqli_query($conn, $fetch_query);

    if (mysqli_num_rows($fetch_query_run) > 0) {
        while ($row = mysqli_fetch_array($fetch_query_run)) {
            echo '
                <div class="card p-4 mb-3" style="font-size: 0.9rem; max-width: 600px; margin: 20px auto; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                    <h5 class="text-center" style="font-size: 1.2rem; margin-bottom: 1rem;">' . htmlspecialchars($row['name']) . '</h5>
                    <div class="row">
                        <div class="col-6 text-left">
                            <h6 style="font-size: 0.95rem; margin-bottom: 0.5rem;">Contact:</h6>
                            <p>' . htmlspecialchars($row['phone']) . '</p>
                        </div>
                        <div class="col-6 text-right">
                            <h6 style="font-size: 0.95rem; margin-bottom: 0.5rem;">Email:</h6>
                            <p>' . htmlspecialchars($row['email']) . '</p>
                        </div>
                    </div>
                </div>';
        }
    } else {
        echo '
        <div class="container mt-4">
            <div class="alert alert-warning text-center" style="font-size: 0.85rem;">
                No official found.
            </div>
        </div>';
    }
}

// edit admin
if (isset($_POST['click_edit_admin'])) {

    $id = $_POST['user_id'];
    $arrayresult = [];

    $fetch_query = "SELECT * FROM users WHERE id='$id' AND role='admin'";
    $fetch_query_run = mysqli_query($conn, $fetch_query);


    if (mysqli_num_rows($fetch_query_run) > 0) {
        while ($row = mysqli_fetch_array($fetch_query_run)) {
            array_push($arrayresult, $row);
            header('content-type: application/json');
            echo json_encode($arrayresult);
        }
    }
}

// update admin
if (isset($_POST['update_admin'])) {
    $id = validate($_POST['id']);
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $update_query = "UPDATE users SET name='$name', phone='$phone', email='$email', password='$hashed_password' WHERE id='$id' AND role='admin'";

    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        header('Location: add-user.php');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}




// INSERTING OFFICIALS DATA

if (isset($_POST['insertOfficial'])) {

    $fullname = validate($_POST['fullname']);
    $position =validate( $_POST['position']);
    $contact = validate($_POST['contact']);
    $term_start = validate($_POST['term_start']);
    $term_end = validate($_POST['term_end']);


    if ($position == 'Barangay Captain') {
        mysqli_query($conn, "UPDATE officials SET is_signatory = 'inactive' WHERE position = 'Barangay Captain'");
    }

    $sql = "INSERT INTO officials (fullname, position, contact, term_start, term_end, is_signatory) 
            VALUES ('$fullname', '$position', '$contact', '$term_start', '$term_end', 
            '" . ($position == 'Barangay Captain' ? 'active' : 'inactive') . "')";

    if ($conn->query($sql) === TRUE) {
        header('Location: official.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// VIEWING OFFICIALS DATA
if (isset($_POST['click_view_btn'])) {
    $id = $_POST['user_id'];

    $fetch_query = "SELECT id, fullname, contact, position, term_start, term_end, status FROM officials WHERE id='$id'";
    $fetch_query_run = mysqli_query($conn, $fetch_query);

    if (mysqli_num_rows($fetch_query_run) > 0) {
        while ($row = mysqli_fetch_array($fetch_query_run)) {
            echo '
            <div class="container mt-2">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-dark text-white text-center">
                        <h4 class="mb-0">' . htmlspecialchars($row['fullname']) . '</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6><strong>Contact:</strong></h6>
                                <p>' . htmlspecialchars($row['contact']) . '</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6><strong>Position:</strong></h6>
                                <p>' . htmlspecialchars($row['position']) . '</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6><strong>Term Started:</strong></h6>
                                <p>' . date("F d, Y", strtotime($row['term_start'])) . '</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6><strong>Term Ended:</strong></h6>
                                <p>' . date("F d, Y", strtotime($row['term_end'])) . '</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h6><strong>Status:</strong></h6>
                                <p>' . htmlspecialchars($row['status']) . '</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo '
        <div class="container mt-4">
            <div class="alert alert-warning text-center" role="alert">
                No official found.
            </div>
        </div>';
    }
}

// EDITING OFFICIALS DATA
if (isset($_POST['click_edit_btn'])) {

    $id = $_POST['user_id'];
    $arrayresult = [];

    $fetch_query = "SELECT * FROM officials WHERE id='$id'";
    $fetch_query_run = mysqli_query($conn, $fetch_query);


    if (mysqli_num_rows($fetch_query_run) > 0) {
        while ($row = mysqli_fetch_array($fetch_query_run)) {
            array_push($arrayresult, $row);
            header('content-type: application/json');
            echo json_encode($arrayresult);
        }
    }
}

// UPDATE OFFICIALS DATA
if (isset($_POST['update_data'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $contact = $_POST['contact'];
    $position = $_POST['position'];
    $term_start = $_POST['term_start'];
    $term_end = $_POST['term_end'];

    $update_query = "UPDATE officials SET fullname='$fullname', contact='$contact', position='$position', term_start='$term_start', term_end='$term_end' WHERE id='$id'";

    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        header('Location: official.php');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Request Approval thru email

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include '../vendor/autoload.php';

if (isset($_POST['action'])) {
    $request_id = $_POST['request_id'];
    $result = $conn->query("SELECT u.email, u.name, cr.certificate_type FROM certificate_requests cr JOIN users u ON cr.user_id = u.id WHERE cr.id = $request_id");
    $data = $result->fetch_assoc();
    $user_email = $data['email'];
    $user_name = $data['name'];
    $certificate_type = $data['certificate_type'];

    if ($_POST['action'] == 'approve') {
        $update_sql = "UPDATE certificate_requests SET status = 'Approved' WHERE id = $request_id";
        $conn->query($update_sql);
        $_SESSION['status'] = "Request Approved!";

        // Send approval email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'brgypuncan@gmail.com';
            $mail->Password = 'jyvv bixb jjjl wlfz';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom("brgypuncan@gmail.com", "Barangay Puncan Certificate Issuance System");
            $mail->addAddress($user_email);
            $mail->isHTML(true);
            $mail->Subject = 'Certificate Request Approved';
            $mail->Body = 'Your certificate request has been approved. You may now pick up your certificate at the barangay hall.';

            $mail->send();
        } catch (Exception $e) {
            echo "Email could not be sent. Error: {$mail->ErrorInfo}";
        }

        header('Location: certificate.php#approved');
        exit();

    } elseif ($_POST['action'] == 'decline') {
        // Capture the decline reason from form data
        $decline_reason = isset($_POST['decline_reason']) ? $conn->real_escape_string($_POST['decline_reason']) : '';

        // Update the database with decline status and reason
        $update_sql = "UPDATE certificate_requests SET status = 'Declined', decline_reason = '$decline_reason' WHERE id = $request_id";
        $conn->query($update_sql);
        $_SESSION['status'] = "Request Declined!";

        // Send decline email with reason
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'brgypuncan@gmail.com';
            $mail->Password = 'jyvv bixb jjjl wlfz';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom("brgypuncan@gmail.com", "Barangay Puncan Certificate Issuance System");
            $mail->addAddress($user_email);
            $mail->isHTML(true);
            $mail->Subject = 'Certificate Request Declined';
            $mail->Body = 'Dear ' . htmlspecialchars($user_name) . ',<br><br>' .
                          'Your certificate request for ' . htmlspecialchars($certificate_type) . ' has been declined for the following reason:<br><br>' .
                          '<strong>' . nl2br(htmlspecialchars($decline_reason)) . '</strong><br><br>' .
                          'Please resolve the issue before reapplying.';

            $mail->send();
        } catch (Exception $e) {
            echo "Email could not be sent. Error: {$mail->ErrorInfo}";
        }

        header('Location: certificate.php#denied');
        exit();

    } elseif ($_POST['action'] == 'print') {
        $update_sql = "UPDATE certificate_requests SET status = 'Released' WHERE id = $request_id";
        $conn->query($update_sql);
        $_SESSION['status'] = "Certificate Printed!";

        // Send ready-for-pickup email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'brgypuncan@gmail.com';
            $mail->Password = 'jyvv bixb jjjl wlfz';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom("brgypuncan@gmail.com", "Barangay Puncan Certificate Issuance System");
            $mail->addAddress($user_email);
            $mail->isHTML(true);
            $mail->Subject = 'Certificate Ready for Pickup';
            $mail->Body = 'Your certificate has been printed and is ready for pickup.';

            $mail->send();
        } catch (Exception $e) {
            echo "Email could not be sent. Error: {$mail->ErrorInfo}";
        }

        header('Location: certificate.php#completed');
        exit();
    }
}

// Request Approval

// add resident details

if (isset($_POST['inputUser'])) {
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

    $role = 'resident';

        $sql = "INSERT INTO users (name, age, phone, bday, gender, status, place, stay, postal, zone, barangay, municipality, province, mother_name, father_name, pendingcase, caseDetails, role) 
            VALUES ('$name', '$age', '$phone', '$bday', '$gender', '$status', '$place', '$stay', '$postal', '$zone', '$barangay', '$municipality', '$province', '$mother_name', '$father_name', '$pendingcase', '$caseDetails','$role')";


        if (mysqli_query($conn, $sql)) {
            echo '<script>
            alert("New Resident Added");
            window.location.href = "resident.php";
            </script>';
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } 

// view resident details

if (isset($_POST['click_view'])) {
    $id = $_POST['user_id'];

    // echo $id;
    $fetch_query = "SELECT * FROM users WHERE id='$id'";
    $fetch_query_run = mysqli_query($conn, $fetch_query);


    if (mysqli_num_rows($fetch_query_run) > 0) {
        while ($row = mysqli_fetch_array($fetch_query_run)) {

            echo '
            <div style="border: 1px solid #ddd; border-radius: 5px; background-color: #f9f9f9;">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;">
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>ID:</strong> ' . $row['id'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Name:</strong> ' . $row['name'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Email:</strong> ' . $row['email'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Age:</strong> ' . $row['age'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Phone:</strong> ' . $row['phone'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Birthday:</strong> ' . $row['bday'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Gender:</strong> ' . $row['gender'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Status:</strong> ' . $row['status'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Birth Place:</strong> ' . $row['place'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Stay:</strong> ' . $row['stay'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Postal:</strong> ' . $row['postal'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Zone:</strong> ' . $row['zone'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Barangay:</strong> ' . $row['barangay'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Municipality:</strong> ' . $row['municipality'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Province:</strong> ' . $row['province'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Mother Name:</strong> ' . $row['mother_name'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Father Name:</strong> ' . $row['father_name'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Pending Case:</strong> ' . $row['pendingcase'] . '
                    </div>
                    <div style="padding: 8px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        <strong>Case Details:</strong> ' . $row['caseDetails'] . '
                    </div>
                </div>
            </div>
        ';
        }
    } else {
        echo '<tr><td colspan="3">NO record found</td></tr>';
    }
}

// edit residet details

if (isset($_POST['click_edit'])) {

    $id = $_POST['user_id'];
    $arrayResult = [];

    // echo $id;
    $fetch_query = "SELECT * FROM users WHERE id='$id'";
    $fetch_query_run = mysqli_query($conn, $fetch_query);


    if (mysqli_num_rows($fetch_query_run) > 0) {

        while ($row = mysqli_fetch_array($fetch_query_run)) {

            array_push($arrayResult, $row);
            header('content-type: application/json');
            echo json_encode($arrayResult);
        }
    } else {
        echo '<tr><td colspan="3">NO record found</td></tr>';
    }
}

// update resident details
if (isset($_POST['update'])) {
    $id = validate($_POST['id']);
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $age = validate($_POST['age']);
    $phone = validate($_POST['phone']);
    $bday = validate($_POST['bday']);
    $gender = validate($_POST['gender']);
    $status = validate($_POST['status']);
    $place = validate($_POST['place']);
    $stay = validate( $_POST['stay']);
    $postal = validate($_POST['postal']);
    $zone = validate($_POST['zone']);
    $barangay = validate($_POST['barangay']);
    $municipality = validate($_POST['municipality']);
    $province = validate($_POST['province']);
    $mother_name = validate($_POST['mother_name']);
    $father_name = validate($_POST['father_name']);
    $pendingcase = validate($_POST['pendingcase']);
    $caseDetails = validate($_POST['caseDetails']);


    $update_query = "UPDATE users SET
    name = '$name',
    email = '$email',
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
WHERE id = '$id'";

    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        $_SESSION['status'] = "Information updated successfully!";
        header('Location: resident.php');
    } else {
        $_SESSION['status'] = "Information not updated successfully!";
        header('Location: resident.php');
    }
}
