<?php
session_start();
include "conn.php";
include "assets/function.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="src/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="img/puncan logo.png">
    <title>Barangay Certificate Issuance System</title>
    <style>
        /* Existing styles */
        body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 80vh;
            margin: 0;
            background: linear-gradient(to bottom right, #e0f7fa, #ffffff);
            font-family: 'Poppins', sans-serif;
        }

        .content {
            background-color: #034f84;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            text-transform: uppercase;
            font-weight: 600;
        }

        h3 {
            color: #073B4C;
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            font-size: 32px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            background-color: #44799c;
            color: white;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.2s;
            font-size: 16px;
            display: block;
            width: 100%;
        }

        .btn:hover {
            background-color: #034f84;
            transform: scale(1.05);
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 20px;
            margin-right: 10px;
        }

        footer {
            background-color: #034f84;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
        }


        sup {
            color: red;
        }

        /* Feedback message styles */
        .form-text {
            font-size: 0.9rem;
        }

        /* Style for toggle button */
        .toggle-password {
            cursor: pointer;
            border: none;
            background: none;
            color: #034f84;
            font-size: 14px;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="logo">
            <img src="img/ph-flag.png" alt="Philippine Flag">
            <label>CARRANGLAN, NUEVA ECIJA</label>
        </div>
        <div>
            <label for="datetime" class="datetime" id="datetime"></label>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="p-4 shadow position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 mt-2 me-2" aria-label="Close" id="closeFormBtn" onclick="window.location.href='index.php';"></button>
                <form action="password_reset.php" method="POST" onsubmit="return validatePasswords()">
                    <h3 class="text-center fw-bold">Change Password</h3>
                    <input type="hidden" name="password_token" value="<?php if (isset($_GET['token'])) {
                                                                            echo $_GET['token'];
                                                                        } ?>">

                    <div class="form-floating mb-3 mt-2">
                        <input type="email" name="email" class="form-control" value="<?php if (isset($_GET['email'])) {
                                                                                            echo $_GET['email'];
                                                                                        } ?>" placeholder="Email Address" required>
                        <label for="email">Email Address<sup>*</sup></label>
                    </div>

                    <div class="form-floating mb-3 mt-2">
                        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password" required oninput="validatePasswordLength()">
                        <label for="new_password">New Password <sup>*</sup></label>
                        <small style="font-family:Arial; font-size:13px;" id="passwordFeedback" class="form-text"></small><br>
                    </div>

                    <div class="form-floating mb-3 mt-2">
                        <input type="password" name="c_password" class="form-control" id="c_password" placeholder="Confirm Password" required oninput="checkPasswordMatch()">
                        <label for="c_password">Confirm Password <sup>*</sup></label>
                        <small style="font-family:Arial; font-size:13px;" id="confirmPasswordFeedback" class="form-text"></small><br>
                    </div>

                    <div class="mb-3 mt-2">
                        <input type="checkbox" class="toggle-password" id="showPassword" onclick="togglePassword()"> <small style="font-family:Arial; font-size:13px;">Show Password</small>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="pass_update" class="btn btn-success w-100 fw-bold">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateDateTime() {
            const now = new Date();
            const optionsDate = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const optionsTime = {
                weekday: 'long',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            };
            const date = now.toLocaleDateString('en-US', optionsDate);
            const time = now.toLocaleTimeString('en-US', optionsTime);
            const formattedDateTime = `${date} ${time}`;
            document.getElementById('datetime').textContent = formattedDateTime;
        }

        function togglePassword() {
            var newPasswordField = document.getElementById('new_password');
            var confirmPasswordField = document.getElementById('c_password');
            var showPasswordCheckbox = document.getElementById('showPassword');

            if (showPasswordCheckbox.checked) {
                newPasswordField.type = "text";
                confirmPasswordField.type = "text";
            } else {
                newPasswordField.type = "password";
                confirmPasswordField.type = "password";
            }
        }

        document.querySelector("form").addEventListener("submit", function(event) {
            var newPassword = document.querySelector("[name='new_password']").value;
            var confirmPassword = document.querySelector("[name='c_password']").value;

            if (newPassword !== confirmPassword) {
                event.preventDefault();
                alert("Passwords do not match! Please try again.");
            }
        });

        function validatePasswordLength() {
            const password = document.getElementById('new_password').value;
            const feedback = document.getElementById('passwordFeedback');

            if (password.length < 8) {
                feedback.textContent = "Password must contain at least 8 characters.";
                feedback.style.color = "red";
            } else {
                feedback.textContent = "Password looks good!";
                feedback.style.color = "green";
            }
        }

        function checkPasswordMatch() {
            const password = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('c_password').value;
            const feedback = document.getElementById('confirmPasswordFeedback');

            if (confirmPassword !== password) {
                feedback.textContent = "Passwords do not match.";
                feedback.style.color = "red";
            } else {
                feedback.textContent = "Passwords match!";
                feedback.style.color = "green";
            }
        }

        function validatePasswords() {
            const password = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('c_password').value;
            const minLength = 8;

            if (password.length < minLength) {
                alert("Password must be at least 8 characters long.");
                return false;
            }

            if (confirmPassword !== password) {
                alert("Passwords do not match!");
                return false;
            }

            return true;
        }

        setInterval(updateDateTime, 1000);
    </script>

    <footer>
        <p>&copy; 2024 Barangay Certificate Issuance System. All Rights Reserved.</p>
    </footer>
</body>

</html>