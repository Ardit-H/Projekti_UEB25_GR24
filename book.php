<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amanpuri Hotel - Book</title>
    <link rel="stylesheet" href="css/headerstyles.css">
    <link rel="stylesheet" href="css/footerstyles.css">
    <link rel="stylesheet" href="css/bookstyles.css">
</head>
<body>
  
  <div id="header"></div>
  <script>
    fetch('header.html')
      .then(res => res.text())
      .then(data => document.getElementById('header').innerHTML = data);
  </script>

  <main >
    <div style="justify-content: center; text-align: center; border-radius: 15px; background-color: #ffde6561; margin-top: -50px;margin-bottom: -30px;">
        <h5 style="font-size: 2rem; color: #f8f8f8;">BOOK NOW</h5>
    </div>  
  </main>

  <div class="center">
      <div class="divform">
        <div class="title"><h1>Booking Form</h1></div>
        <form method="POST" action="php/book_now.php">

            <label for="name">Name:</label><br>
            <input type="text" placeholder="Name" id="name" name="name" required><br>

            <label for="telefon">Telefon:</label><br>
            <input type="text" placeholder="+383 000-000-000" pattern="[+0-9]{1,15}" id="telefon" name="telefon" maxlength="15" required><br>

            <label for="email" >Email:</label><br>
            <input type="email"  placeholder="Name@gmail.com" id="email" name="email" required><br>
            
            <label for="checkin">Check-in Date:</label><br>
            <input type="date" id="checkin" name="checkin" required><br>
            
            <label for="checkout">Check-out Date:</label><br>
            <input type="date" id="checkout" name="checkout" required><br>
            
            <label for="room">Room Type:</label><br>
            <select id="room" name="room" required>
              <option value="single">Single Room</option>
              <option value="double">Double Room</option>
              <option value="suite">Suite</option>
            </select><br>

            <label for="cardnumber">Card Number:</label><br>
            <input type="text" placeholder="xxxx xxxx xxxx xxxx" id="cardnumber" name="cardnumber" pattern="\d{16}" maxlength="16" required>

            <div style="text-align: center; margin:30px;">
              <button type="submit">Book Now</button>
            </div>
        </form>
      </div>
  </div>
<?php
  include("php/book_now.php");
?>
  <div id="footer"></div>
  <script>
     fetch('footer.html')
       .then(response => response.text())
       .then(data => document.getElementById('footer').innerHTML = data);
  </script>
</body>
</html>
