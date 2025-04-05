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
        <div class="tab" onclick="switchForm('car', event)">🚗 Car Pickup</div>
        <div class="tab" onclick="switchForm('lost', event)">🕵️ Lost Item</div>
      </div>

      <div class="form-container">
        <div class="center form-section active">
          <div class="form">
            <form id="flight" action="" method="POST">
              <label>Name:</label>
              <input type="text" name="name" required />
              <label>Lastname:</label>
              <input type="text" name="lastname" required />
              <label>Email:</label>
              <input type="email" name="email" required />
              <label>Phone Number:</label>
              <input type="tel" name="phone" required />
              <label>Flight Number:</label>
              <input type="text" name="flight_number" required />
              <label>Arrival Date:</label>
              <input type="date" name="arrival_date" required />
              <label>Additional Notes:</label>
              <textarea name="notes"></textarea>
              <button type="submit">Submit Flight Details</button>
            </form>
          </div>
        </div>

        <div class="center form-section">
          <div class="form">
            <form id="car" method="POST">
              <label>Name:</label>
              <input type="text" name="name" required />
              <label>Lastname:</label>
              <input type="text" name="lastname" required />
              <label>Email:</label>
              <input type="email" name="email" required />
              <label>Phone Number:</label>
              <input type="tel" name="phone" required />
              <label>Pickup Date & Time:</label>
              <input type="datetime-local" name="pickup_time" required />
              <label>Pickup Location:</label>
              <input type="text" name="pickup_location" required />
              <label>Destination:</label>
              <input type="text" name="destination" required />
              <label>Vehicle Preference:</label>
              <select name="vehicle">
                <option>Sedan</option>
                <option>SUV</option>
                <option>Minivan</option>
                <option>Luxury</option>
              </select>
              <label>Additional Notes:</label>
              <textarea name="notes"></textarea>
              <button type="submit">Request Pickup</button>
            </form>
          </div>
        </div>

        <div class="center form-section">
          <div class="form">
            <form id="lost" action="" method="POST">
              <label>Name:</label>
              <input type="text" name="name" required />
              <label>Lastname:</label>
              <input type="text" name="lastname" required />
              <label>Email:</label>
              <input type="email" name="email" required />
              <label>Phone Number:</label>
              <input type="tel" name="phone" required />
              <label>Preferred Time to Contact:</label>
              <select name="preferred_time">
                <option>Morning</option>
                <option>Afternoon</option>
                <option>After 5 PM</option>
              </select>
              <label>Reason for Contact:</label>
              <select name="reason">
                <option>Item left in room</option>
                <option>Item lost in common area</option>
                <option>Item lost during check-out</option>
                <option>Other</option>
              </select>
              <label>Date of Stay:</label>
              <input type="date" name="stay_date" required />
              <label>Room Number:</label>
              <input type="text" name="room_number" />
              <label>Item Description:</label>
              <textarea name="item_description" required></textarea>
              <label>Additional Comments:</label>
              <textarea name="additional_info"></textarea>
              <button type="submit">Submit Report</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php 
  include("footer.php");
  ?>

    <script>
      function switchForm(formId, event) {
        if (event) event.preventDefault();

        document
          .querySelectorAll(".form-section")
          .forEach((f) => f.classList.remove("active"));

        document
          .querySelectorAll(".tab")
          .forEach((t) => t.classList.remove("active"));

        const targetForm = document.getElementById(formId);
        const formContainer = targetForm.closest(".form-section");
        if (formContainer) {
          formContainer.classList.add("active");
        }

        event.target.classList.add("active");
      }
    </script>
  </body>
</html>
