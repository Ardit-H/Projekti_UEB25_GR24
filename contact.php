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
    <div style="margin: 20px auto; width: 90%; text-align: center;">
        <h3 style="color: white;">Update Notes for a Flight</h3>
        <label for="flightNumberInput" style="color: white;">Flight Number:</label>
        <input type="text" id="flightNumberInput" placeholder="Enter Flight Number" maxlength="4" style="padding: 5px; margin: 10px;">
        <br>
        <label for="notesInput" style="color: white;">Notes:</label>
        <textarea id="notesInput" placeholder="Enter your notes" style="padding: 5px; margin: 10px; width: 50%;"></textarea>
        <br>
        <button id="updateNotesButton" style="padding: 10px 20px; background-color: #ffde65; border: none; cursor: pointer;">Update Notes</button>
    </div>

    <section id="contact" style="margin: 50px 0; text-align: center;">
  <h2 style="color: #f5c518;">Contact us</h2>
  <form id="contact-form" action="send_email.php" method="POST" style="max-width: 500px; margin: auto;">
    <div style="margin-bottom: 20px;">
      <label for="name" style="display: block; color: #ffffff;">Name</label>
      <input type="text" id="name" name="name" placeholder="Type name" required 
        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    </div>
    <div style="margin-bottom: 20px;">
      <label for="email" style="display: block; color: #ffffff;">Email</label>
      <input type="email" id="email" name="email" placeholder="Type email" required 
        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
    </div>
    <div style="margin-bottom: 20px;">
      <label for="message" style="display: block; color: #ffffff;">Message</label>
      <textarea id="message" name="message" rows="5" required placeholder="Type the message you want to send us"
        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
    </div>
    <button type="submit" 
      style="background-color: #f5c518; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
      Send
    </button>
  </form>
  <div id="message-box" style="display: none; margin-top: 20px; padding: 10px; border-radius: 5px;"></div>
</section>

    
    <script>
        $(document).ready(function () {
            $("#updateNotesButton").click(function () {
                const flightNumber = $("#flightNumberInput").val().trim();
                const notes = $("#notesInput").val().trim();
    
                if (!flightNumber || !notes) {
                    alert("Please fill in both the Flight Number and Notes fields.");
                    return;
                }
    
                $.ajax({
                    url: "php/updateNotes.php",
                    method: "POST",
                    data: { flight_number: flightNumber, notes: notes },
                    success: function (response) {
                        alert(response);
                        $("#flightNumberInput").val(""); // Clear input fields
                        $("#notesInput").val("");
                    },
                    error: function () {
                        alert("An error occurred while updating the notes.");
                    }
                });
            });
        });
    </script>

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

<script>
  document.getElementById('contact-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Parandalon ringarkimin e faqes

    // Merr të dhënat nga forma
    const name = document.querySelector('#contact-form #name').value.trim();
    const email = document.querySelector('#contact-form #email').value.trim();
    const message = document.querySelector('#contact-form #message').value.trim();
    const messageBox = document.getElementById('message-box');

    // Kontrollon nëse fushat janë të mbushura
    if (!name || !email || !message) {
      alert("Ju lutemi plotësoni të gjitha fushat.");
      return;
    }

    // Dergo të dhënat në server
    fetch('send_email.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&message=${encodeURIComponent(message)}`,
    })
      .then(response => response.text())
      .then(data => {
        // Shfaq rezultatin e dërgimit
        messageBox.style.display = 'block';
        if (data.includes('Mesazhi u dërgua me sukses!')) {
          messageBox.style.backgroundColor = '#d4edda'; // E gjelbër (sukses)
          messageBox.style.color = '#155724';
          messageBox.textContent = 'Mesazhi u dërgua me sukses!';
        } else {
          messageBox.style.backgroundColor = '#f8d7da'; // E kuqe (gabim)
          messageBox.style.color = '#721c24';
          messageBox.textContent = 'Gabim gjatë dërgimit të mesazhit.';
        }
      })
      .catch(error => {
        // Trajton gabimet e papritura
        messageBox.style.display = 'block';
        messageBox.style.backgroundColor = '#f8d7da'; // E kuqe (gabim)
        messageBox.style.color = '#721c24';
        messageBox.textContent = 'Një gabim i papritur ndodhi.';
      });
  });
</script>
</html>
