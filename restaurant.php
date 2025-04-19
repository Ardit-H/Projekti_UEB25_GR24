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
  <div style="color: #f5c518;justify-content: center; text-align: center;"><h1> Our Indoor Dining Area</h1></div>
    <div class="photo" style="margin-bottom: 100px; ">
      <img src="foto/Terrace1.png" alt="Terrace">
      <img src="foto/Terrace4.jpg" alt="Terrace">
      <img src="foto/Terrace5.jpg" alt="Terrace">
      <img src="foto/Terrace8.jpg" alt="Terrace">
  </div>
   <?php 
   $totalMeals = 100;
   $seafood = 30;
   $meat = 20;
   $sushi = 20;
   $burgers = 18;
   $pizza = 12;

   $seafoodpercent = ($seafood / $totalMeals) * 100;
   $meatpercent = ($meat / $totalMeals) * 100;
   $sushipercent = ($sushi / $totalMeals) * 100;
   $burgerspercent = ($burgers / $totalMeals) * 100;
   $pizzapercent = ($pizza / $totalMeals) * 100;
   ?>

   <style>
    .menu-breakdown{
      width: 80%;
      max-width: 600px;
      margin: 60px auto;
      /* background-color:#ffffff0d; */
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgda(0,0,0,0.2);
      color: #f5c518;
      font-family: 'Segoe UI', sans-serif;
    }
    .menu-breakdown h3{
      text-align: center;
      font-size: 1.8rem;
      margin-bottom: 30px;
    }
    .category{
      display: flex;
      justify-content: space-between;
      align-items:center;
      background-color:#333;
      border-radius: 50px;
      padding: 12px 20px;
      margin: 10px 0;
      font-size: 1.1rem;
      animation: fadeIn 1s ease-in;
    }
    .category span{
      font-weight: bold;
    }
    .icon{
      font-size: 1.3rem;
      margin-right:10px;
    }

    @keyframes fadeIn{
      from{ opacity: 0; transform: translateY(20px);}
      to{ opacity: 1; transform: translateY(0);}
    }
    </style>
    <div class="menu-breakdown">
      <h3>🍽️ Menu Breakdown by Category</h3>
      <div class="category">
        <div><span class="icon">🐟</span>Seafood</div>
        <span><?php echo round($seafoodpercent); ?>%</span>
      </div>
      <div class="category">
        <div><span class="icon">🥩</span>Meat</div>
        <span><?php echo round($meatpercent); ?>%</span>
      </div>
      <div class="category">
        <div><span class="icon">🍣</span>Sushi</div>
        <span><?php echo round($sushipercent); ?>%</span>
      </div>
      <div class="category">
        <div><span class="icon">🍔</span>Burgers</div>
        <span><?php echo round($burgerspercent); ?>%</span>
      </div>
      <div class="category">
        <div><span class="icon">🍕</span>Pizza</div>
        <span><?php echo round($pizzapercent); ?>%</span>
      </div>
  </div>

      <?php 
  include("footer.php");
  ?>
</body>
</html>
