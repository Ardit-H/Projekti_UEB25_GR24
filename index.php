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
  include("footer.php");
  ?>

  
</body>
</html>
