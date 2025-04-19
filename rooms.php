
<?php
define("CURRENCY","$");
class Room{
  protected $name;
  public $price;
  protected $images;
  protected $rating;
    public function __construct($name,$price,$images,$rating ){
      $this->name=$name;
      $this->price=$price;
      $this->images=$images;
      $this->rating = $rating;
    }
    public function getRating() {
      return $this->rating;
  }
  protected function extraDetails() {
    echo "<p class='room-detail'>" . "📶 Wifi"."</p>";
}
protected function description(){

}
    public function displayRoom(){
     echo" <div class='room'>";
     echo "<h1 style='color: #f5c518; justify-content: center; text-align: center; padding: 20px;'>" . htmlspecialchars($this->name) . "</h1>";
  //    echo "<div class='photo-gallery' style='margin-bottom: 10px;'>"; 

  //    foreach ($this->images as $image) {
  //     echo "<img src='foto/" . htmlspecialchars($image) . "' alt='" . htmlspecialchars($this->name) . "'>";
  //    }
  // echo "</div>";
      $this->displayPhotos();
  echo "<div class='room-details' style='display: flex; justify-content: space-between; align-items: center; padding: 0 20px;'>";
  //left
  echo "<div style='flex: 1; text-align: left;'>"; 
$this->extraDetails(); 
echo "</div>";
//center
echo "<div style='flex: 1; text-align: center;'>";
$this->description();
echo "</div>";
//right
echo "<div style='flex: 1; text-align: right;'>";
echo "<p class='rating' >Rating: " . $this->rating . "★</p>";
echo "<h3 class='price'>Price: " . CURRENCY . number_format($this->price, 2) . " per night</h3>";
echo "<a href=\"book.php?room=$this->name \"><button class='book-now-button' style='background-color: #f5c518; padding: 15px 30px; font-size: 18px; border: none; border-radius: 5px; cursor: pointer;'>". strtoupper("Book Now") ."</button></a>";
echo "</div>";

echo "</div></div>";

    }
    protected function displayPhotos() {
      echo "<div class='photo-gallery' style='margin-bottom: 10px;'>";
      foreach ($this->images as $image) {
         echo "<img src='foto/" . htmlspecialchars($image) . "' alt='" . htmlspecialchars($this->name) . "' style='cursor:pointer;' />";
      }
      echo "</div>";
    }
}class StandardRoom extends Room {
  private $tv;
  private $bedSize;

  public function __construct($name, $price, $images,$rating, $tv = true,$bedSize="Queen") {
      parent::__construct($name, $price, $images,$rating);
      $this->tv = $tv;
      $this->bedSize=$bedSize;
  }

  protected function extraDetails() {
    parent::extraDetails();
    echo "<p class='room-detail'>" . ($this->tv ? "📺" : "❌") . " TV</p>";
    echo "<p class='room-detail'> 🛏️ Bed Size: " . $this->bedSize . "</p>";

}
protected function description(){
  echo "<p class='room-detail'>"."A warm and comfortable room for a pleasant stay. Equipped with Wi-Fi and TV for entertainment during your stay. Ideal for short getaways and excursions." ."</p>";
}
}

class LuxuryRoom extends Room {
  private $miniBar;
  private $jacuzzi;

  public function __construct($name, $price, $images,$rating,$miniBar = true, $jacuzzi = true) {
      parent::__construct($name, $price, $images,$rating);
      $this->miniBar = $miniBar;
      $this->jacuzzi = $jacuzzi;
  }

  protected function extraDetails() {
    parent::extraDetails();
    echo "<p class='room-detail'>" . ($this->miniBar ? "🍹" : "❌") . " Mini Bar</p>";
    echo "<p class='room-detail'>" . ($this->jacuzzi ? "🛁" : "❌") . " Jacuzzi</p>";

}
protected function description(){
  echo "<p class='room-detail'>"."Designed for those seeking unparalleled luxury and comfort. This room offers stunning views, a minibar, and a private jacuzzi for a relaxing and unforgettable experience." ."</p>";
}
}

class FamilyRoom extends Room {
  private $numBeds;
  private $kidFriendly;

  public function __construct($name, $price, $images,$rating,$numBeds = 4, $kidFriendly = true) {
    parent::__construct($name, $price, $images,$rating);
    $this->numBeds = $numBeds;
    $this->kidFriendly = $kidFriendly; 
  }

  protected function extraDetails() {
    parent::extraDetails();
    echo "<p class='room-detail'>🛏️ Number of Beds: " . $this->numBeds . " </p>";
    echo "<p class='room-detail'>" . ($this->kidFriendly ? "👶" : "❌") . " Kid Friendly</p>";

}
protected function description(){
  echo "<p class='room-detail'>"."A perfect room for families, offering spaciousness and plenty of beds. Kid-friendly and equipped with all the amenities to make your stay comfortable and enjoyable." ."</p>";
}
}
class PrivateVillas extends Room {
  private $privatePool;
  private $butlerService;

  public  function __construct($name, $price, $images,$rating,$privatePool = true, $butlerService = true) {
    parent::__construct($name, $price, $images,$rating);
    $this->privatePool = $privatePool;
    $this->butlerService = $butlerService;
  }

  protected function extraDetails() {
    parent::extraDetails();
    echo "<p class='room-detail'>" . ($this->privatePool ? "🏊‍♂️" : "❌") . " Private Pool</p>";
    echo "<p class='room-detail'>" . ($this->butlerService ? "🤵" : "❌") . " Butler Service</p>";
  }
  protected function description(){
    echo "<p class='room-detail'>"."For an exclusive experience, these private villas offer a private pool and butler service for all your needs. Ideal for those seeking privacy and luxury in one." ."</p>";
  }
}

class WellnessSuite extends Room {
  private $spaServices;
  private $personalTrainer;

  public  function __construct($name, $price, $images,$rating,$spaServices = true, $personalTrainer = true) {
    parent::__construct($name, $price, $images,$rating);
    $this->spaServices = $spaServices;
    $this->personalTrainer = $personalTrainer;
  }

  protected function extraDetails() {
    parent::extraDetails();
    echo "<p class='room-detail'>" . ($this->spaServices ? "💆‍♀️" : "❌") . " Spa Services</p>";
    echo "<p class='room-detail'>" . ($this->personalTrainer ? "💪" : "❌") . " Personal Trainer</p>";
  }
  protected function description(){
    echo "<p class='room-detail'>"."Relax and recharge in this wellness suite with spa services and the option for personal trainer treatments. Perfect for those looking for a rejuvenating experience." ."</p>";
  }
}
$rooms = [
  new StandardRoom("Standard Room", 250, ["standard room1.jpg", "Aman_Amanpuri_Dining_2_0.webp", "standard room.jpg", "Aman_Amanpuri_Dining_7_0.webp"],4),
  new LuxuryRoom("Luxury Room", 1500, ["luxoryroom1.jpg", "luxoryroom2.jpg", "luxoryroom3.jpg", "luxoryroom4.jpg"],5),
  new FamilyRoom("Family Room", 750, ["familyroom1.jpg", "familyroom2.jpg", "familyroom3.jpg", "familyroom4.jpg"],3),
  new PrivateVillas("Private Villas", 900, ["villat1.jpg", "villat2.jpg", "villat3.jpg", "villat4.jpg"],5),
  new WellnessSuite("Wellness Suite", 1250, ["wellnesssuite1.jpg", "wellnesssuite2.jpg", "wellnesssuite3.jpg", "wellnesssuite4.jpg"],4),
];
usort($rooms, function($a, $b) {
  return $a->price - $b->price;
});
if (isset($_GET['filter'])) {
  $filter = $_GET['filter'];

  if ($filter == 'price') {
      usort($rooms, function($a, $b) {
          return $a->price - $b->price;
      });
  } elseif ($filter == 'rating') {
      usort($rooms, function($a, $b) {
          return $b->getRating() - $a->getRating(); 
      });
  }
}
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
      cursor: pointer;
            transition: transform 0.3s ease;
    }
    .photo-gallery img:hover {
            transform: scale(1.05);
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
        height: 535px; /* Set your desired height */
        margin-bottom:25px;
    }
    .room-detail {
  color: black;
}
.room-details {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
    }
    .rating{
      margin-bottom: 5px;
      color: #000000;
    }
    .price{
      margin-top:5px;
      margin-bottom: 9px;
      color: #000000;
    }
     input[type="submit"] {
      background-color: #e4b00f;
        border-radius: 5px;
        border: 1px solid #000000;
    }
    select{
      border-radius: 5px;
    }
     input[type="submit"]:hover {
      background-color: rgb(255, 255, 255); 
      transform: scale(1.05); 
      transition: all 0.3s ease-out; 
     }
    /* Filter section background */
    .filter-section {
        border-radius: 15px;
        padding: 10px;
        margin-bottom: 30px;
    }
    .modal-backdrop {
            position: fixed;
            top: 0; left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease-in-out;
        }
        .modal-img {
            max-width: 85%;
            max-height: 85%;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(0,0,0,0.5);
            animation: zoomIn 0.4s ease;
        }
        .close-btn {
            position: absolute;
            top: 30px;
            right: 40px;
            font-size: 36px;
            color: white;
            cursor: pointer;
            z-index: 10000;
        }
        @keyframes zoomIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
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
  
  <form method="GET" action="">
    <label for="filter">Filter by:</label>
    <select name="filter" id="filter">
        <option value="price" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'price') echo 'selected'; ?>>Price</option>
        <option value="rating" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'rating') echo 'selected'; ?>>Rating</option>
    </select>
    <input type="submit" value="Apply Filter">
  </form>
  
  
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
 <script>
    document.querySelectorAll('.photo-gallery img').forEach(img => {
        img.addEventListener('click', function () {
            const modal = document.createElement("div");
            modal.className = "modal-backdrop";
            modal.innerHTML = `
                <span class="close-btn">&times;</span>
                <img src="${this.src}" class="modal-img" />
            `;
            document.body.appendChild(modal);

            // Mbyll kur klikon jashtë imazhit
            modal.addEventListener('click', function (e) {
                if (e.target === modal || e.target.classList.contains('close-btn')) {
                    modal.remove();
                }
            });
        });
    });
    </script>
</body>
</html>
