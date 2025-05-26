<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Amanpuri Hotel</title>
  <link rel="stylesheet" href="css/headerstyles.css">
  <link rel="stylesheet" href="css/footerstyles.css">

  <style>
    .photo-gallery {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Makes it responsive */
      gap: 30px;
      margin: 50px 0;
    }

    .photo-gallery img {
      width: 100%;  /* Makes each image take up the full width of its container */
      height: 250px; /* Fixed height, you can adjust this value */
      object-fit: cover;  /* Ensures the image fills the container without distortion */
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adds a subtle shadow around images */
    }
  </style>
</head>
<body>
  <?php 
  include("header.php");
  ?>

  <main >
    <div style="justify-content: center; text-align: center; border-radius: 15px; background-color: #ffde6561; margin-top: -50px;margin-bottom: -30px;">
      <h5 style="font-size: 2rem; color: #f8f8f8;">HOME</h5> <!-- Smaller font-size -->
    </div>
    
    <h2 style="color: #f5c518;justify-content: center; text-align: center;">Welcome to Amanpuri Hotel</h2>
    <p style=" font-size: 1.5rem ;padding :30px;justify-content: center; text-align: center; border-radius: 10px; background-color: #ffffff25;color:#f5c518;margin: 50px 0;">Welcome to Amanpuri, the crown jewel of luxury resorts in Phuket, Thailand. Located on the idyllic shores of the Andaman Sea, 
      our resort offers a perfect harmony of nature, culture, and unmatched comfort. With breathtaking views of turquoise waters,
       lush landscapes, and opulent villas, Amanpuri promises an experience like no other.
</p>
  </main> 
  <div style="color: #f5c518;justify-content: center; text-align: center;"><h1> Our Outdoor Spaces</h1></div>

  <div class="photo-gallery" style="margin-bottom: 100px; ">
    <img src="foto/Nine-Bedroom Ocean Villa, Amanpuri, Thailand_Square.jpg" alt="Amanpuri Resort 1">
    <img src="foto/amanpuri-resort-phuket-thailand.jpg" alt="Amanpuri Resort 2">
    <img src="foto/439176-amanpuri-phuket.webp" alt="Amanpuri Resort 3">
    <img src="foto/Amanpuri-Wellness-Resort-Thailand-Aerial-View.jpg" alt="Amanpuri Resort 4">
    <img src="foto/Amanpuri-21.jpg" alt="Amanpuri Resort 4">
    <img src="foto/amanpuri-phuket-thailand-5.jpg" alt="Amanpuri Resort 1">
    <img src="foto/amanpuri-phuket-thailand-conde-nast-traveller-31jan17-pr_.webp" alt="Amanpuri Resort 4">
    <img src="foto/Premium-Pavillion-at-Amanpuri-Thailand-1024x683.jpg" alt="Amanpuri Resort 1">

  </div>

  <div style="color: #f5c518;justify-content: center; text-align: center;"><h1> Join Us for an Unforgettable Dining Experience at Amanpuri</h1></div>

  <div class="photo-gallery" style="margin-bottom: 100px; "> 
    <img src="foto/Aman_Amanpuri_Dining_6_0.webp" alt="Amanpuri Resort 1">
    <img src="foto/Aman_Amanpuri_Dining_2_0.webp" alt="Amanpuri Resort 2">
    <img src="foto/images.jpg" alt="Amanpuri Resort 3">
    <img src="foto/Aman_Amanpuri_Dining_7_0.webp" alt="Amanpuri Resort 4">
  </div>
  <?php
    if (!isset($_SESSION['roli'])) {
        $_SESSION['roli'] = 'user'; 
    }

    $role = $_SESSION['roli'];
    if ($role === 'admin'): 
  ?>


    <div style="color: #f5c518;justify-content: center; text-align: center;">
      <h1>Environments</h1>
    </div>

    <div style="text-align: center; margin-bottom: 30px;">
      <input type="text" id="new-ambient" placeholder="Add a new environment" style="padding: 8px; width: 300px; border-radius: 5px; border: none;">
      <button id="add-ambient-btn" style="padding: 8px 12px; background: #f5c518; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">Add</button>
    </div>

    <div id="ambientet-container" style="text-align:center; margin-bottom: 50px;">
      <h3 style="color:#f5c518;">Environments:</h3>
      <ul id="ambientet-list" style="list-style:none; padding:0; color:white; max-width: 400px; margin: 0 auto;"></ul>
    </div>
  <?php else: ?>
    <div style="color: #f5c518;justify-content: center; text-align: center;"><h1> Our Featured Environments</h1></div>

  <ul style="list-style:none; padding:0; text-align:center; color:white;">
    <?php
    // Lexo ambientet nga ambientet.json
    $ambientetJson = file_get_contents('ambientet.json');
    $ambientetArray = json_decode($ambientetJson, true);

    // Shfaq secilin ambient
    if ($ambientetArray && is_array($ambientetArray)) {
      foreach ($ambientetArray as $ambient) {
        echo "<li>" . htmlspecialchars($ambient) . "</li>";
      }
    } else {
      echo "<li>No environments available.</li>";
    }
    ?>
  </ul>

    <!-- // $GLOBALS['ambientet'] = array(
    //   "Infinity Pool",
    //   "Beach Lounge",
    //   "Sunset Bar",
    //   "Ocean Pavilion",
    //   "Spa & Wellness Center"
    // );

    // function renditRritje() {
    //   global $ambientet; 
    //   sort($ambientet); 
    //   echo "<div style='text-align:center; margin-bottom: 30px;'>";
    //   echo "<h3 style='color:#f5c518;'>Environments:</h3>";
    //   echo "<ul style='list-style:none; padding:0; color:white;'>";
    //   foreach ($ambientet as $a) {
    //     echo "<li>$a</li>";
    //   }
    //   echo "</ul></div>";
    // }

    // function renditZbritje() {
    //   global $ambientet; 
    //   rsort($ambientet); 
    //   echo "<div style='text-align:center;'>";
    //   echo "<h3 style='color:#f5c518;'>Environments:</h3>";
    //   echo "<ul style='list-style:none; padding:0; color:white;'>";
    //   foreach ($ambientet as $a) {
    //     echo "<li>$a</li>";
    //   }
    //   echo "</ul></div>";
    // }

    
    // renditRritje();
    // renditZbritje(); -->
  <?php endif; ?> 
  <script>
    // Funksioni për të shtuar një ambient me AJAX (POST)
  function addAmbient() {
    const newAmbient = document.getElementById('new-ambient').value.trim();
    if (!newAmbient) {
      alert('Ju lutemi shkruani emrin e ambientit që dëshironi të shtoni.');
      return;
    }

    fetch('ambientet.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'ambient=' + encodeURIComponent(newAmbient)
    })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          document.getElementById('new-ambient').value = ''; // Pastro fushën pas shtimit
          loadAmbientet(); // Përditëso listën
        } else {
          alert('Gabim: ' + (data.message || 'Nuk u mundësua shtimi.'));
        }
      })
      .catch(err => alert('Gabim gjatë shtimit të ambientit: ' + err));
  }

  // Ngarko ambientet kur faqja të jetë gati
  document.addEventListener('DOMContentLoaded', () => {
    loadAmbientet();

    // Lidh funksionin me butonin Add
    document.getElementById('add-ambient-btn').addEventListener('click', addAmbient);
  });
  // Funksioni për të fshirë një ambient me AJAX (DELETE)
  function deleteAmbient(ambient) {
    fetch('ambientet.php', {
      method: 'DELETE',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'ambient=' + encodeURIComponent(ambient)
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        loadAmbientet();
      } else {
        alert('Gabim: ' + data.message);
      }
    })
    .catch(err => alert('Gabim gjatë fshirjes së ambientit: ' + err));
  }

  // Përditëso funksionin e ngarkimit për të shtuar opsionin e fshirjes
  function loadAmbientet() {
    fetch('ambientet.php')
      .then(response => response.json())
      .then(data => {
        const list = document.getElementById('ambientet-list');
        list.innerHTML = '';
        data.forEach(a => {
          const li = document.createElement('li');
          li.textContent = a;

          // Shto një buton për fshirje
          const deleteBtn = document.createElement('button');
          deleteBtn.textContent = 'Delete';
          deleteBtn.style.marginLeft = '10px';
          deleteBtn.style.padding = '5px 10px';
          deleteBtn.style.background = '#ff4d4d';
          deleteBtn.style.color = 'white';
          deleteBtn.style.border = 'none';
          deleteBtn.style.borderRadius = '5px';
          deleteBtn.style.cursor = 'pointer';

          // Event për fshirje
          deleteBtn.addEventListener('click', () => deleteAmbient(a));

          li.appendChild(deleteBtn);
          list.appendChild(li);
        });
      })
      .catch(err => console.error('Gabim në ngarkimin e ambientëve:', err));
  }

  // Ngarko ambientet kur faqja të jetë gati
  document.addEventListener('DOMContentLoaded', loadAmbientet);
</script>


  
  <?php 
  include("footer.php");
  ?>

  
</body>
</html>
