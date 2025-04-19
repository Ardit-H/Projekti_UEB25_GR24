<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amanpuri Hotel - Book</title>
    <link rel="stylesheet" href="css/headerstyles.css">
    <link rel="stylesheet" href="css/footerstyles.css">
    <link rel="stylesheet" href="css/bookstyles.css">
    <script>
        function calculateTotalPrice() {
            var roomSelect = document.getElementById("room");
            var selectedRoom = roomSelect.options[roomSelect.selectedIndex].text;
            var pricePerNight = roomSelect.options[roomSelect.selectedIndex].getAttribute("data-price");

            var checkinDate = document.getElementById("checkin").value;
            var checkoutDate = document.getElementById("checkout").value;

            if (!checkinDate || !checkoutDate) {
                document.getElementById("totalPrice").innerText = "Please select check-in and check-out dates.";
                return;
            }

            var checkin = new Date(checkinDate);
            var checkout = new Date(checkoutDate);

            var timeDiff = checkout - checkin;
            var numOfDays = timeDiff / (1000 * 3600 * 24); 

            if (numOfDays <= 0) {
                document.getElementById("totalPrice").innerText = "Check-out date must be after check-in date.";
                return;
            }

            var totalPrice = numOfDays * pricePerNight;

            document.getElementById("totalPrice").innerText = "Total Price for " + selectedRoom + ": $" + totalPrice.toFixed(2);
        }
    </script>
</head>
<body>
  
<?php 
  include("header.php");
  ?>

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
            <input type="text" placeholder="+383 000-000-000" pattern="(^[+-]?\d{3}-)?\d{3}-?\d{3}-?\d{3}$" id="telefon" name="telefon" maxlength="16" required><br>

            <label for="email" >Email:</label><br>
            <input type="email"  placeholder="Name@gmail.com" id="email" name="email" required><br>
            
            <label for="checkin">Check-in Date:</label><br>
            <input type="date" id="checkin" name="checkin" required onchange="calculateTotalPrice()"><br>
            
            <label for="checkout">Check-out Date:</label><br>
            <input type="date" id="checkout" name="checkout" required onchange="calculateTotalPrice()"><br>
            
            <?php 
            $selectedRoom = $_GET['room'] ?? '';
            ?>
            <label for="room">Room Type:</label><br>
            <select id="room" name="room" required onchange="calculateTotalPrice()">
              <option value="Standard Room" data-price="250" <?= $selectedRoom === 'Standard Room' ? 'selected' : '' ?>>Standard Room</option>
              <option value="Family Room" data-price="750" <?= $selectedRoom === 'Family Room' ? 'selected' : '' ?>>Family Room</option>
              <option value="Private Villas" data-price="900" <?= $selectedRoom === 'Private Villas' ? 'selected' : '' ?>>Private Villas</option>
              <option value="Wellness Suite" data-price="1250" <?= $selectedRoom === 'Wellness Suite' ? 'selected' : '' ?>>Wellness Suite</option>
              <option value="Luxury Room" data-price="1500" <?= $selectedRoom === 'Luxury Room' ? 'selected' : '' ?>>Luxury Room</option>
            </select><br>

            <label for="cardnumber">Card Number:</label><br>
            <input type="text" placeholder="XXXXYYYYZZZZEEEE" id="cardnumber" name="cardnumber" pattern="\d{16}" maxlength="16" required>
            
            <div id="totalPrice" style="font-weight: bold; margin-top: 10px;color:green;height: 30px; font-size: 1.2rem;"></div>
            <div style="text-align: center; margin:30px; ">
              <button type="submit">Book Now</button>
            </div>
        </form>
      </div>
  </div>

  <?php 
  include("footer.php");
  ?>
</body>
</html>
