<?php
session_start();

$message = isset($_GET['message']) ? $_GET['message'] : '';

session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script>
        window.onload = function() {
            var message = "<?php echo addslashes($message); ?>"; 
            if (message) {
                alert(message);
            }
            setTimeout(function() {
                window.location.href = "pages/login.php"; 
            }, 1000); 
        };
    </script>
</head>
<body>
</body>
</html>
