
<?php
//Numerimi i vizitave ne faqen rooms.php
session_start();
require_once("database.php");

if (isset($_SESSION['user_id'])&& isset($_SESSION['roli']) && $_SESSION['roli'] === 'user') {
    $userId = $_SESSION['user_id'];

    // Kontrollo nëse ekziston një rekord për këtë user
    $stmt = $conn->prepare("SELECT * FROM user_visits WHERE user_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            // Update: rrit numrin e vizitave dhe përditëso kohën
            $updateStmt = $conn->prepare("UPDATE user_visits SET visit_count = visit_count + 1, last_visit = NOW() WHERE user_id = ?");
            if ($updateStmt) {
                $updateStmt->bind_param("i", $userId);
                $updateStmt->execute();
                $updateStmt->close();
            } else {
                die("Gabim ne UPDATE prepare: " . $conn->error);
            }
        } else {
            // Insert: regjistro vizitën e parë
            $insertStmt = $conn->prepare("INSERT INTO user_visits (user_id, visit_count) VALUES (?, 1)");
            if ($insertStmt) {
                $insertStmt->bind_param("i", $userId);
                $insertStmt->execute();
                $insertStmt->close();
            } else {
                die("Gabim ne INSERT prepare: " . $conn->error);
            }
        }

        $stmt->close();
    } else {
        die("Gabim ne SELECT prepare: " . $conn->error);
    }
}

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
    public function getName() {
        return $this->name;
    }
    public function getRating() {
      return $this->rating;
  }
  public function setRating($rating) {
    if (is_numeric($rating) && $rating >= 0 && $rating <= 5) {
        $this->rating = $rating;
    } else {
        throw new Exception("Rating duhet të jetë një numër midis 0 dhe 5.");
    }
}
  protected function extraDetails() {
    echo "<p class='room-detail'>" . "📶 Wifi"."</p>";
}
protected function description(){

}
    public function displayRoom(){
      // Merr vargun e pëlqimeve nga cookie
    $likedRooms = isset($_COOKIE['liked_rooms']) ? json_decode($_COOKIE['liked_rooms'], true) : [];
    $isLiked = in_array($this->name, $likedRooms) ? 'liked' : '';
     echo" <div class='room'>";
     echo "<h1 style='color: #f5c518; justify-content: center; text-align: center; padding: 20px;'>" . htmlspecialchars($this->name) . "</h1>";

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
echo "<div style='display: flex; justify-content: flex-end; align-items: center;height:30px; gap:7px'>";
echo "<p class='heart $isLiked' data-room-name='" . htmlspecialchars($this->name) . "'>❤</p>";
echo "<p class='rating' >Rating: " . $this->rating . "★</p>";
echo "</div>";
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
$rooms[0]->setRating(3.5);
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

//Dhomat e vizituara
if (isset($_SESSION['user_id'])) {
    if (!isset($_SESSION['viewed_rooms'])) {
        $_SESSION['ទ_rooms'] = [];
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
      margin-bottom: 15px;
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
        .heart {
    font-size: 24px;
    cursor: pointer;
    color: #ccc;
    transition: transform 0.3s ease, color 0.3s ease;
    float: right;
    user-select: none;
}

.heart:hover {
    transform: scale(1.2);
    color: #999;
}

.heart.liked {
    color: red;
}
.filter-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 20px auto;
    padding: 10px;
    border-radius: 15px;
    max-width: 1000px;
}

.filter-container form {
    display: flex;
    align-items: center;
    gap: 10px;
}

.filter-container .clear-likes-btn,
.filter-container .clear-viewed-btn {
    margin-left: 10px;
}

.clear-likes-btn {
    background-color: #f5c518;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.clear-likes-btn:hover {
    background-color: #e4b00f;
    transform: scale(1.05);
}
.clear-viewed-btn {
    background-color: #f5c518;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
    margin-left: 10px; /* Hapësirë mes butonit të pëlqimeve dhe këtij butoni */
}

.clear-viewed-btn:hover {
    background-color: #e4b00f;
    transform: scale(1.05);
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
  
<div class="filter-container">
    <form method="GET" action="">
        <label for="filter">Filter by:</label>
        <select name="filter" id="filter">
            <option value="price" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'price') echo 'selected'; ?>>Price</option>
            <option value="rating" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'rating') echo 'selected'; ?>>Rating</option>
        </select>
        <input type="submit" value="Apply Filter">
    </form>
    <?php if (isset($_SESSION['user_id'])): ?>
        <button id="clearLikes" class="clear-likes-btn">Remove all likes</button>
        <button id="clearViewedRooms" class="clear-viewed-btn">Clear Viewed Rooms</button>
    <?php endif; ?>
</div>
  
  <?php
  foreach ($rooms as $room) {
    $room->displayRoom();
  }
  //Lista e dhomave te vizituara nga perdoruesi
  ?>
  <?php if (isset($_SESSION['user_id']) && isset($_SESSION['viewed_rooms']) && !empty($_SESSION['viewed_rooms'])): ?>
    <div class="viewed-rooms-container">
      <span>Visited rooms: <?php echo htmlspecialchars(implode(', ', $_SESSION['viewed_rooms'])); ?></span>
    </div>
 
<?php endif; ?>
  <audio id="likeAudio" src="Like-audio.mp3.mp3" preload="auto"></audio>
  <?php 
  include("footer.php");
  ?>
 <script>
    document.querySelectorAll('.photo-gallery img').forEach(img => {
      img.addEventListener('click', function () {
        const roomName = this.closest('.room').querySelector('h1').textContent;
        const modal = document.createElement("div");
        modal.className = "modal-backdrop";
        modal.innerHTML = `
          <span class="close-btn">×</span>
          <img src="${this.src}" class="modal-img" />
        `;
        document.body.appendChild(modal);
        modal.addEventListener('click', function (e) {
          if (e.target === modal || e.target.classList.contains('close-btn')) {
            modal.remove();
          }
        });

        //Dergo kerkesen AJAX per ta shtuar dhomen ne listen e dhomave
        fetch('Rooms/add_viewed_room.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ roomName: roomName }),
        })
        .then(response => response.json())
        .then(result => {
          if (result.success) {
            console.log('Room added to viewed rooms:', roomName);
            updateViewedRooms(roomName);
          } else {
            console.error('Error:', result.error);
          }
        })
        .catch(error => {
          console.error('Request failed:', error);
        });
      });
    });

    //Funksion per te ndryshuar ne menyre dinamike listen e dhomave te vizituara
    function updateViewedRooms(roomName) {
      let viewedRoomsContainer = document.querySelector('.viewed-rooms-container');
      if (!viewedRoomsContainer) {
        //Nese  nuk ekziston conatineri viewed-rooms krijoje nje
        viewedRoomsContainer = document.createElement('div');
        viewedRoomsContainer.className = 'viewed-rooms-container';
        viewedRoomsContainer.innerHTML = '<span>Visited rooms: </span>';
        const footer = document.querySelector('footer');
        document.body.insertBefore(viewedRoomsContainer, footer);
      }

      //Merre listen akutale 
      const span = viewedRoomsContainer.querySelector('span');
      let currentRooms = span.textContent.replace('Visited rooms: ', '').split(', ').filter(room => room !== '');
     //Shtoje dhomen nese nuk eshte ne liste
      if (!currentRooms.includes(roomName)) {
        currentRooms.push(roomName);
        span.textContent = `Visited rooms: ${currentRooms.join(', ')}`;
      }
    }

    document.querySelectorAll('.heart').forEach(heart => {
      heart.addEventListener('click', async function () {
        const roomName = this.getAttribute('data-room-name');
        const isLiked = this.classList.contains('liked');
        const action = isLiked ? 'unlike' : 'like';

        try {
          const response = await fetch('Rooms/manage_likes.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({ roomName, action }),
          });

          const result = await response.json();

          if (result.success) {
            if (action === 'like') {
              this.classList.add('liked');
              const audio = document.getElementById('likeAudio');
              audio.play();
            } else {
              this.classList.remove('liked');
            }
          } else {
            console.error('Error:', result.error);
          }
        } catch (error) {
          console.error('Request failed:', error);
        }
      });
    });

    document.getElementById('clearLikes').addEventListener('click', async function () {
      if (!confirm('A jeni i sigurt që doni të fshini të gjitha pëlqimet?')) return;

      try {
        const response = await fetch('Rooms/clear_likes.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
        });

        const result = await response.json();
        if (result.success) {
          document.querySelectorAll('.heart').forEach(heart => {
            heart.classList.remove('liked');
          });
          alert('Të gjitha pëlqimet u fshinë me sukses!');
        } else {
          console.error('Error:', result.error);
          alert('Dështoi fshirja e pëlqimeve: ' + result.error);
        }
      } catch (error) {
        console.error('Request failed:', error);
        alert('Ndodhi një gabim gjatë fshirjes së pëlqimeve.');
      }
    });

    const clearViewedRoomsBtn = document.getElementById('clearViewedRooms');
    if (clearViewedRoomsBtn) {
      clearViewedRoomsBtn.addEventListener('click', async function () {
        if (!confirm('A jeni i sigurt që doni të pastroni listën e dhomave të shikuara?')) return;

        try {
          const response = await fetch('Rooms/clear_viewed_rooms.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
          });

          const result = await response.json();
          if (result.success) {
            const viewedRoomsContainer = document.querySelector('.viewed-rooms-container');
            if (viewedRoomsContainer) {
              viewedRoomsContainer.remove();
            }
            alert('Lista e dhomave të shikuara u pastrua me sukses!');
          } else {
            console.error('Error:', result.error);
            alert('Dështoi pastrimi i listës: ' + result.error);
          }
        } catch (error) {
          console.error('Request failed:', error);
          alert('Ndodhi një gabim gjatë pastrimit të listës.');
        }
      });
    }
  </script>
</body>
</html>
