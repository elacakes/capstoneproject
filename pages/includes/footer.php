
<!-- <br><br><br> -->

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

       setInterval(updateDateTime, 1000);
       updateDateTime();
   </script>

<footer>
        <p>&copy; 2024 Barangay Certificate Issuance System. All Rights Reserved.</p>
    </footer>
   </body>

   </html>