
<?php
define("CURRENCY","$");
class Room{
  public $name;
  public $price;
  public $images;
    public function __construct($name,$price,$images){
      $this->name=$name;
      $this->price=$price;
      $this->images=$images;
    }
    public function displayRoom(){
     echo" <div class='room'>";
     echo "<h1 style='color: #f5c518; justify-content: center; text-align: center; padding: 20px;'>" . htmlspecialchars($this->name) . "</h1>";
     echo "<div class='photo-gallery' style='margin-bottom: 10px;'>"; 

     foreach ($this->images as $image) {
      echo "<img src='foto/" . htmlspecialchars($image) . "' alt='" . htmlspecialchars($this->name) . "'>";
  }

  echo "</div>";
  echo "<div style='text-align: center;'>";
  echo "<a href='book.php'><button class='book-now-button' style='background-color: #f5c518; padding: 15px 30px; font-size: 18px; border: none; border-radius: 5px; cursor: pointer;'>Book Now</button></a>";
  echo "<h3 style='color: #000000;'>Price: " . CURRENCY . number_format($this->price, 2) . " per night</h3>";
  echo "</div></div>";

    }
}
$rooms = [
  new Room("Standard Room", 250, ["standard room1.jpg", "Aman_Amanpuri_Dining_2_0.webp", "standard room.jpg", "Aman_Amanpuri_Dining_7_0.webp"]),
  new Room("Luxury Room", 1500, ["luxoryroom1.jpg", "luxoryroom2.jpg", "luxoryroom3.jpg", "luxoryroom4.jpg"]),
  new Room("Private Villas", 900, ["villat1.jpg", "villat2.jpg", "villat3.jpg", "villat4.jpg"]),
  new Room("Family Room", 750, ["familyroom1.jpg", "familyroom2.jpg", "familyroom3.jpg", "familyroom4.jpg"]),
  new Room("Wellness Suite", 1250, ["wellnesssuite1.jpg", "wellnesssuite2.jpg", "wellnesssuite3.jpg", "wellnesssuite4.jpg"])
];
usort($rooms, function($a, $b) {
  return $a->price - $b->price;
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Amanpuri Hotel - Rooms</title>
  <link rel="stylesheet" href="css/headerstyles.css">
  <link rel="stylesheet" href="css/footerstyles.css">

  <style>
    .photo-gallery {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Makes it responsive */
      gap: 20px;
      margin: 50px 20px;
    }

    .photo-gallery img {
      width: 90%;  /* Makes each image take up the full width of its container */
      height: 250px; /* Fixed height, you can adjust this value */
      object-fit: cover;  /* Ensures the image fills the container without distortion */
      border-radius: 10px;
      border: 5px solid #f5c518;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adds a subtle shadow around images */
    }

    .book-now-button:hover {
      background-color: #e4b00f; /* Darker shade of yellow */
      transform: scale(1.05); /* Slightly enlarge the button */
      transition: all 0.3s ease-in-out; /* Smooth transition */
    }
    .room{
        background-color:rgb(255, 255, 255);
        border-radius: 20px; 
        margin-left: 20px; 
        margin-right: 20px;
        height: 500px; /* Set your desired height */
        margin-bottom:50px;
    }
  </style>
</head>
<body>
    <?php 
      include("header.php");
      ?>
  <main>
    <div style="justify-content: center; text-align: center; border-radius: 15px; background-color: #ffde6561; margin-top: -50px;margin-bottom: -30px;">
      <h5 style="font-size: 2rem; color: #f8f8f8;">ROOMS</h5>
    </div>
  </main>

  
  
  <?php
  foreach ($rooms as $room) {
      $room->displayRoom();
  }
  ?>
<!-- <div class="room">
    <h1 style="color: #f5c518; justify-content: center; text-align: center; padding: 20px;"> Standard Room </h1>
    <div class="photo-gallery" style="margin-bottom: 10px;"> 
      <img src="foto/standard room1.jpg" alt="Amanpuri Resort 1">
      <img src="foto/Aman_Amanpuri_Dining_2_0.webp" alt="Amanpuri Resort 2">
      <img src="foto/standard room.jpg" alt="Amanpuri Resort 3">
      <img src="foto/Aman_Amanpuri_Dining_7_0.webp" alt="Amanpuri Resort 4">
    </div>
    <div style="text-align: center;">
      <a href="book.html">
      <button class="book-now-button" style="background-color: #f5c518; padding: 15px 30px; font-size: 18px; border: none; border-radius: 5px; cursor: pointer;">
        Book Now
      </button>
    </a>
      <h3 style="color: #000000;">Price: $250 per night</h3>
    </div>
  </div>

  <div class="room">
    <h1 style="color: #f5c518; justify-content: center; text-align: center; padding: 20px;"> Luxory Room </h1>
    <div class="photo-gallery" style="margin-bottom: 10px;"> 
      <img src="foto/luxoryroom1.jpg" alt="Amanpuri Resort 1">
      <img src="foto/luxoryroom2.jpg" alt="Amanpuri Resort 2">
      <img src="foto/luxoryroom3.jpg" alt="Amanpuri Resort 3">
      <img src="foto/luxoryroom4.jpg" alt="Amanpuri Resort 4">
    </div>
    <div style="text-align: center;">
      <a href="book.html">
      <button class="book-now-button" style="background-color: #f5c518; padding: 15px 30px; font-size: 18px; border: none; border-radius: 5px; cursor: pointer;">
        Book Now
      </button>
    </a>
      <h3 style="color: #000000;">Price: $1500 per night</h3>
    </div>
  </div>

  <div class="room">
    <h1 style="color: #f5c518; justify-content: center; text-align: center; padding: 20px;"> Private Villas </h1>
    <div class="photo-gallery" style="margin-bottom: 10px; align-items: center;"> 
      <img src="foto/villat1.jpg" alt="Amanpuri Resort 1">
      <img src="foto/villat2.jpg" alt="Amanpuri Resort 2">
      <img src="foto/villat3.jpg" alt="Amanpuri Resort 3">
      <img src="foto/villat4.jpg" alt="Amanpuri Resort 4">
    </div>
    <div style="text-align: center;">
      <a href="book.html">
      <button class="book-now-button" style="background-color: #f5c518; padding: 15px 30px; font-size: 18px; border: none; border-radius: 5px; cursor: pointer;">
        Book Now
      </button>
    </a>
      <h3 style="color: #000000;">Price: $900 per night</h3>
    </div>
  </div>
  <div class="room">
    <h1 style="color: #f5c518; justify-content: center; text-align: center; padding: 20px;"> Family Room </h1>
    <div class="photo-gallery" style="margin-bottom: 10px; align-items: center;"> 
      <img src="foto/familyroom1.jpg" alt="Amanpuri Resort 1">
      <img src="foto/familyroom2.jpg" alt="Amanpuri Resort 2">
      <img src="foto/familyroom3.jpg" alt="Amanpuri Resort 3">
      <img src="foto/familyroom4.jpg" alt="Amanpuri Resort 4">
    </div>
    <div style="text-align: center;">
      <a href="book.html">
      <button class="book-now-button" style="background-color: #f5c518; padding: 15px 30px; font-size: 18px; border: none; border-radius: 5px; cursor: pointer;">
        Book Now
      </button>
    </a>
      <h3 style="color: #000000;">Price: $750 per night</h3>
    </div>
  </div>
  <div class="room">
    <h1 style="color: #f5c518; justify-content: center; text-align: center; padding: 20px;"> Wellness Suite </h1>
    <div class="photo-gallery" style="margin-bottom: 10px; align-items: center;"> 
      <img src="foto/wellnesssuite1.jpg" alt="Amanpuri Resort 1">
      <img src="foto/wellnesssuite2.jpg" alt="Amanpuri Resort 2">
      <img src="foto/wellnesssuite3.jpg" alt="Amanpuri Resort 3">
      <img src="foto/wellnesssuite4.jpg" alt="Amanpuri Resort 4">
    </div>
    <div style="text-align: center;">
      <a href="book.html">
      <button class="book-now-button" style="background-color: #f5c518; padding: 15px 30px; font-size: 18px; border: none; border-radius: 5px; cursor: pointer;">
        Book Now
      </button>
    </a>
      <h3 style="color: #000000;">Price: $1250 per night</h3>
    </div>
  </div> -->

  <?php 
  include("footer.php");
  ?>
</body>
</html>
