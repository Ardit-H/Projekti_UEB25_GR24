<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Amanpuri Hotel - Resturant</title>
  <link rel="stylesheet" href="css/headerstyles.css">
  <link rel="stylesheet" href="css/footerstyles.css">

  <style>
    .photo{
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Makes it responsive */
      gap: 30px;
      margin: 50px 0;
    }

    .photo img{
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
        <h5 style="font-size: 2rem; color: #f8f8f8;">RESTAURANT</h5> <!-- Smaller font-size -->
      </div> 
      
      <h2 style="color: #f5c518;justify-content: center; text-align: center;">Welcome to Amanpuri Restaurant</h2>
      <p style=" font-size: 1.5rem ;padding :30px;justify-content: center; text-align: center; border-radius: 10px; background-color: #ffffff25;color:#f5c518;margin: 50px 0;">
      Join us for a unique experience with a rich menu that includes fresh seafood, a variety of expertly prepared meats, handcrafted pizzas, flavorful Australian burgers, masterfully made Japanese sushi, and much more.
      Each dish is crafted with passion to satisfy every palate – from the most traditional to the most adventurous. Our welcoming and modern atmosphere is perfect for a dinner with friends, a family lunch, or a special night out. 
</p>
    </main>
    <div style="color: #f5c518;justify-content: center; text-align: center;"><h1> Our Meals</h1></div>

    <div class="photo" style="margin-bottom: 100px; ">
      <img src="foto/Restaurant1.jpg" alt="Restaurant">
      <img src="foto/Restaurant2.jpg" alt="Restaurant">
      <img src="foto/Restaurant3.jpg" alt="Restaurant">
      <img src="foto/Restaurant4.jpg" alt="Restaurant">
      <img src="foto/Restaurant5.jpg" alt="Restaurant">
      <img src="foto/Restaurant6.jpg" alt="Restaurant">
      <img src="foto/Restaurant7.jpg" alt="Restaurant">
      <img src="foto/Restaurant8.jpg" alt="Restaurant">
  </div>
  <div style="color: #f5c518;justify-content: center; text-align: center;"><h1> Our Outdoor Dining Area</h1></div>
    <div class="photo" style="margin-bottom: 100px; ">
      <img src="foto/Terrace2.jpg" alt="Terrace">
      <img src="foto/Terrace3.jpg" alt="Terrace">
      <img src="foto/Terrace6.jpg" alt="Terrace">
      <img src="foto/Terrace7.jpg" alt="Terrace">
  </div>

      <?php 
  include("footer.php");
  ?>
</body>
</html>
