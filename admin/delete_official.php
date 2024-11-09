<?php
include "../conn.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $delete_query = "DELETE FROM officials WHERE id='$id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        header('Location: official.php'); 
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
