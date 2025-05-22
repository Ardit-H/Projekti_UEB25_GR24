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
    <?php 
              if(isset($_SESSION["user_id"])):     
            if (isset($_GET['success']) && $_GET['success'] == '1') {
                echo '<div style="color: green; text-align: center; font-size: 1.5rem; margin: 20px;">
                        Reservation successful!
                      </div>';
            }
?>
      <div class="center">
          <div class="divform">
            <div class="title"><h1>Booking Form</h1></div>
            
              <form method="POST" action="php/handle_book_now.php">          

                  <label for="name">Name:</label><br>
                  <input style="background-color:lightgrey ; color:black " type="text" value="<?=$_SESSION['firstname']; ?>" id="name" name="name" required readonly><br>

                  <label for="Lastname">Lastname:</label><br>
                  <input style="background-color:lightgrey ; color:black " type="text" value="<?=$_SESSION['lastname']; ?>" id="Lastname" name="Lastname" required readonly><br>

                  <label for="telefon" >Telefon:</label><br>
                  <input style="background-color:lightgrey ; color:black " type="text" value="<?=$_SESSION['phone']; ?>" pattern="(^[+-]?\d{3}-)?\d{3}-?\d{3}-?\d{3}$" id="telefon" name="telefon" maxlength="16" required readonly><br>

                  <label for="email" >Email:</label><br>
                  <input style="background-color:lightgrey ; color:black " type="email" value="<?=$_SESSION['email']; ?>" id="email" name="email" required><br>

                  <label for="cardnumber">Card Number:</label><br>
                  <input style="background-color:lightgrey ; color:black " type="text" value="<?=$_SESSION['card_number']; ?>" id="cardnumber" name="cardnumber" pattern="\d{16}" maxlength="16" required><br>
                  
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

                  <div id="totalPrice" style="font-weight: bold; margin-top: 2px; margin-bottom: 5px; color:green ; height: 50px; font-size: 1.2rem;"></div>
                  <div style="text-align: center; margin:30px; ">
                    <button type="submit" name="submit">Book Now</button>
                  </div>
              </form>
          </div> 
      </div>
    <?php else: ?>
      <div style="text-align: center; padding: 20px; color: red;">
        <h2>You must be logged in to access the booking form.</h2>
        <a href="login.php" style="color: blue; text-decoration: underline;">Click here to log in</a>
      </div> 
    <?php endif; ?>

    <?php  include("footer.php"); ?>
  </body>
</html>
