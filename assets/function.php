<?php
function validate($inputData){
    global $conn;

    return mysqli_real_escape_string($conn, $inputData);
}

function alertMessage($color = 'black')
{
    if (isset($_SESSION['status'])) {
        echo "<div style='color: $color;'>
                <h6>" . $_SESSION['status'] . "</h6>
              </div>";
        unset($_SESSION['status']);
    }
}

function Word($date) {
    $timestamp = strtotime($date);
    return date('F j, Y', $timestamp);
}
?>