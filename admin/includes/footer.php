 <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</body>

<script>
   let idleTime = 0;
let idleInterval = setInterval(timerIncrement, 1000); 
let countdownInterval;

function timerIncrement() {
    idleTime++;
    if (idleTime >= 10*60) { 
        showModal();
    }
}

function showModal() {
    if (!document.getElementById('warningModal').style.display || document.getElementById('warningModal').style.display === 'none') {
        document.getElementById('warningModal').style.display = 'flex';
        startCountdown(30); 
    }
}

function startCountdown(seconds) {
    let countdownElement = document.getElementById('countdown');
    countdownElement.innerHTML = seconds;

    countdownInterval = setInterval(function() {
        seconds--;
        countdownElement.innerHTML = seconds;

        if (seconds <= 0) {
            clearInterval(countdownInterval);
            window.location.href = '../logout.php'; 
        }
    }, 1000);
}

document.onkeypress = function() {
    idleTime = 0;
    document.getElementById('warningModal').style.display = 'none'; 
    clearInterval(countdownInterval); 
};

document.getElementById('stayLogin').onclick = function() {
    idleTime = 0; 
    document.getElementById('warningModal').style.display = 'none'; 
    clearInterval(countdownInterval); 
};

document.getElementById('logout').onclick = function() {
    window.location.href = '../logout.php'; 
};

</script>


 </html>