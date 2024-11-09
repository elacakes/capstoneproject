<?php

$timeout = 600; 

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    session_unset();     
    session_destroy();   
    header("Location: logout.php"); 
    exit();
}

$_SESSION['last_activity'] = time();

?>
<div id="warningModal" style="position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); display: flex; justify-content: center; align-items: center; padding: 10px; display:none;">
    <div class="modal-card" style="background-color: #f5f9ff; padding: 30px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); width: 400px; max-width: 90%; text-align: center; font-family: 'Arial', sans-serif; border: 1px solid #d3e0f1; animation: fadeIn 0.4s ease;">
        <h2 style="font-size: 24px; margin-bottom: 15px; color: #1a73e8; font-weight: bold;">Session Timeout Warning</h2>
        <p style="font-size: 16px; color: #333; margin-bottom: 20px;">Your session will expire soon due to inactivity.</p>
        <p style="font-size: 16px; color: #333; margin-bottom: 20px;">Do you want to stay logged in?</p>
        <p id="countdownTimer" style="font-size: 16px; color: #333; margin-bottom: 20px;">You will be logged out in <span id="countdown">30</span> seconds.</p>
        <div class="button-group" style="display: flex; justify-content: space-between; gap: 15px; margin-top: 20px;">
            <button id="stayLogin" style="padding: 12px 24px; font-size: 16px; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease; color: white; width: 100%; background: linear-gradient(145deg, #4a90e2, #357ab7);">Stay Logged In</button>
            <button id="logout" style="padding: 12px 24px; font-size: 16px; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease; color: white; width: 100%; background: linear-gradient(145deg, #3c76c0, #255a96);">Logout</button>
        </div>
    </div>
</div>  

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>
