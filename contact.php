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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
      #resultFlights {
        margin: 20px auto;
        width: 90%;
        color: white;
      }

      #resultFlights table {
        width: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        color: black;
        border-radius: 5px;
      }     

      #resultFlights th {
        background-color: #ffde65;
        color: black;
        padding: 8px;
      }

      #resultFlights td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
      } 
    </style>
  </head>
  <body>
  <?php 
  include("header.php");
  ?>
    <?php 
              if(isset($_SESSION["user_id"])):     
            if (isset($_GET['success']) && $_GET['success'] == '1') {
                echo '<div style="color: green; text-align: center; font-size: 1.5rem; margin: 20px;">
                          Your contact message has been sent successfully!
                      </div>';
            }
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
      
        <div id="resultDiv" ></div>

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
              style="background-color: lightgrey; color:black"
              type="text"  
              name="name" 
              id="name"
              placeholder="Name" required 
              readonly 
              value="<?php echo isset($_SESSION['firstname']) ? htmlspecialchars($_SESSION['firstname']) : ''; ?>"
              />
              <label>Last Name:</label>
              <input
                style="background-color: lightgrey; color:black"
                type="text"
                id="lastname"
                name="lastname"
                placeholder="Lastname"
                required
                readonly 
                value="<?php echo isset($_SESSION['lastname']) ? htmlspecialchars($_SESSION['lastname']) : ''; ?>"
              />
              <label>Email:</label>
              <input
                style="background-color: lightgrey; color:black"
                type="email"
                id="email"
                name="email"
                placeholder="name@gmail.com"
                required
                readonly 
                value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>"
              />
              <label>Phone Number:</label>
              <input
                style="background-color: lightgrey; color:black"
                type="tel"
                name="phone"
                id="phonenumber"
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
                id="flight_number"
                placeholder="1235"
                minlength="1"
                maxlength="4"
                required
              />
              <label>Arrival Date:</label>
              <input type="date" name="arrival_date" required  id="arrival_date"/>
              <label>Additional Notes:</label>
              <textarea name="notes" id="notes"></textarea>
              <input type="hidden" name="form_type" value="flight" />
              <div id="butonDiv">
              <button type="submit" name="send" id="send" class="btn-style" style="margin-left: 60px;">Submit Flight Details</button>
              <button type="button" id="displayRequests" style="margin-top: 20px; margin-left: 65px;">
              Show my flight requests
              </button>
              </div>
            </form>
            <div id="resultFlights" style="margin-top: 20px;"></div>
          </div>
        </div>
      </div>
    </div>
    <?php else: ?>
      <div style="text-align: center; padding: 20px; color: red;">
        <h2>You must be logged in to access the contact form.</h2>
        <a href="login.php" style="color: blue; text-decoration: underline;">Click here to log in</a>
      </div> 
    <?php endif; ?>

    <?php 
  include("footer.php");
  ?>
   <script>
  if (window.location.search.includes("success=flights")) {
    setTimeout(() => {
      const url = new URL(window.location);
      url.searchParams.delete("success");
      window.history.replaceState({}, document.title, url.pathname);
    }, 3000); 
  }
</script>
  </body>
  <script>
 $(document).ready(function () {
    $("#displayRequests").click(function () {
        $.ajax({
            url: "php/getFlights.php",
            method: "GET",
            success: function (response) {
                if(response.includes("<table")) {
                    $("#resultFlights").html(response);
                } else {
                    $("#resultFlights").html("<div style='color:white;background:#ffde6561;padding:10px;border-radius:5px;'>" + response + "</div>");
                }
            },
            error: function () {
                $("#resultFlights").html("<div style='color:red;'>Error loading requests: </div>");
            }
        });
    });
});
</script>
</html>
