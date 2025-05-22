<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Amanpuri Hotel - Contact</title>
    <link rel="stylesheet" href="css/headerstyles.css" />
    <link rel="stylesheet" href="css/footerstyles.css" />
    <link rel="stylesheet" href="css/contacts.css" />
  </head>
  <body>
  <?php 
  include("header.php");
  ?>

    <div class="">
      <div
        style="
          text-align: center;
          border-radius: 15px;
          background-color: #ffde6561;
          margin-top: -50px;
        "
      >
        <h5 style="font-size: 2rem; color: #f8f8f8">CONTACT</h5>
      </div>

      <div class="tabs">
        <div class="tab active" onclick="switchForm('flight',event)">
          ✈️ Flight Assistance
        </div>
      </div>

      <div class="form-container">
        <div class="center form-section active">
          <div class="form">
            <form id="flight" action="php/submitRequest.php" method="POST">
              <label>Name:</label>
              <input 
              type="text" 
              name="name" 
              placeholder="Name" required 
              readonly 
              value="<?php echo isset($_SESSION['firstname']) ? htmlspecialchars($_SESSION['firstname']) : ''; ?>"
              />
              <label>Last Name:</label>
              <input
                type="text"
                name="lastname"
                placeholder="Lastname"
                required
                readonly 
                 value="<?php echo isset($_SESSION['lastname']) ? htmlspecialchars($_SESSION['lastname']) : ''; ?>"
              />
              <label>Email:</label>
              <input
                type="email"
                name="email"
                placeholder="name@gmail.com"
                required
                readonly 
                 value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>"
              />
              <label>Phone Number:</label>
              <input
                type="tel"
                name="phone"
                placeholder="+383 000-000-000"
                pattern="[+0-9]{1,15}"
                maxlength="15"
                required
                readonly
                 value="<?php echo isset($_SESSION['phone']) ? htmlspecialchars($_SESSION['phone']) : ''; ?>"
              />
              <label>Flight Number:</label>
              <input
                type="text"
                name="flight_number"
                placeholder="1235"
                minlength="1"
                maxlength="4"
                required
              />
              <label>Arrival Date:</label>
              <input type="date" name="arrival_date" required />
              <label>Additional Notes:</label>
              <textarea name="notes"></textarea>
              <input type="hidden" name="form_type" value="flight" />
              <button type="submit">Submit Flight Details</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php 
  include("footer.php");
  ?>
  </body>
</html>
