<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
  <title>Amanpuri Hotel - About</title>
  <link rel="stylesheet" href="css/headerstyles.css">
  <link rel="stylesheet" href="css/footerstyles.css">
</head>
<body>
<?php 
include_once("header.php");
include_once("database.php");

$user_id = $_SESSION['user_id'] ?? null;
$firstname = $_SESSION['firstname'] ?? '';
$lastname = $_SESSION['lastname'] ?? '';
$username = trim($firstname . " " . $lastname);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!$user_id) {
        header("Location: login.php");
        exit();
    }

    if (!empty($_POST['visitor_comment']) && !empty($_POST['visitor_name'])) {
        $newComment = trim($_POST['visitor_comment']);
        $newName = trim($_POST['visitor_name']);

        $stmt = $conn->prepare("INSERT INTO comments (user_id, comment, name) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $newComment, $newName);
        $stmt->execute();
        $stmt->close();

        header("Location: about.php");
        exit();
    }
}

$sql = "
    SELECT name, comment, created_at
    FROM comments    
";

$result = $conn->query($sql);


  ?>

  <main >
    <div style="justify-content: center; text-align: center; border-radius: 15px; background-color: #ffde6561; margin-top: -50px;margin-bottom: -10px;">
        <h5 style="font-size: 2rem; color: #f8f8f8;">ABOUT</h5> <!-- Smaller font-size -->
      </div>  </main>


<div style="background-color:rgb(255, 255, 255);border-radius: 10px;color:black;padding:20px ;margin-bottom:80px;margin-left: 20px; margin-right: 20px;">
    <h2 style="font-size: 2rem; color: #ffde65;">Location</h2>
    <p>Hotel is located in the idyllic and picturesque region of <span style="background-color: #ffde65; padding: 0 5px;border-radius:20px;">Phuket, Thailand</span>, a world-renowned tropical paradise known 
        for its crystal-clear waters, lush landscapes, and serene atmosphere. The resort is nestled along the tranquil shores of the Andaman Sea, 
        offering guests sweeping views of white sandy beaches and the surrounding island vistas. Its prime location allows visitors to enjoy both 
        privacy and access to the vibrant culture and activities that Phuket has to offer. From exploring hidden coves and snorkeling in pristine waters 
        to enjoying the peaceful ambiance of the resort's expansive grounds, Amanpuri's location is a true sanctuary of natural beauty, offering guests a 
        perfect escape from the outside world.</p>
</div>

<div style="background-color:rgb(255, 255, 255);border-radius: 10px;color:black;padding:20px ;margin-bottom:80px ;margin-left: 20px; margin-right: 20px;">
    <h2 style="font-size: 2rem; color: #ffde65;">History</h2>
    <p> Founded in <span style="background-color: #ffde65; padding: 0 5px;border-radius:20px;">1988</span>, Amanpuri was the first resort in the Aman collection, marking the beginning of a new era of luxury, exclusivity, and understated 
        elegance. Over the years, it has set a new standard for high-end resorts, blending traditional Thai architecture with modern amenities and an unwavering 
        focus on providing an intimate, personalized experience for each guest. Amanpuri quickly gained recognition as a destination for discerning travelers 
        seeking privacy, luxury, and tranquility. With its unique location and serene atmosphere, Amanpuri became a hallmark of the Aman brand and remains one 
        of the most iconic and sought-after resorts in the world. Its legacy continues to inspire the Aman group’s philosophy of creating exceptional, secluded 
        retreats that prioritize both luxury and authenticity.</p>
</div>

<div style="background-color:rgb(255, 255, 255);border-radius: 10px;color:black;padding:20px ;margin-bottom:80px ;margin-left: 20px; margin-right: 20px;">
    <h2 style="font-size: 2rem; color: #ffde65;">The Future</h2>
    <p> Looking ahead, Amanpuri is committed to maintaining its position as a leader in luxury travel by continually enhancing the guest experience while staying 
        true to its roots of privacy, serenity, and natural beauty. The future of the resort will focus on integrating sustainable practices, preserving the local 
        environment, and offering innovative, immersive experiences that connect guests to the culture and traditions of Thailand. Future plans include expanding 
        wellness offerings, developing exclusive culinary experiences, and providing more opportunities for guests to explore the unspoiled beauty of Phuket’s natural 
        surroundings. With a focus on sustainability and a commitment to exceptional service, Amanpuri is poised to remain a top choice for travelers seeking an 
        extraordinary and timeless escape for generations to come.</p>
</div>

<?php
  $visitorComments = [];
    
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'] ?? "Anonymous";
        $comment = $row['comment'];
        $date = $row['created_at'] ?? date("Y-m-d");

        if (!isset($visitorComments[$name])) {
            $visitorComments[$name] = [];
        }

        $visitorComments[$name][] = [
            "comment" => $comment,
            "created_at" => $date
        ];
    }
}
$conn->close();


if (isset($_GET['commentsort'])) {
    $sortOption = $_GET['commentsort'];

    switch ($sortOption) {
        case 'name_asc':
            ksort($visitorComments);
            break;
        case 'name_desc':
            krsort($visitorComments); 
            break;
        case 'date_asc':

            $dates = [];
            foreach ($visitorComments as $name => $data) {
                $dates[$name] = $data['created_at'];
            }
            asort($dates);
            $sorted = [];
            foreach ($dates as $name => $d) {
                $sorted[$name] = $visitorComments[$name];
            }
            $visitorComments = $sorted;
            break;
        case 'date_desc':
            $dates = [];
            foreach ($visitorComments as $name => $data) {
                $dates[$name] = $data['created_at'];
            }
            arsort($dates);
            $sorted = [];
            foreach ($dates as $name => $d) {
                $sorted[$name] = $visitorComments[$name];
            }
            $visitorComments = $sorted;
            break;
    }
}
?>

<div style="background-color:rgb(255, 255, 255);border-radius: 10px;color:black;padding:20px ;margin-bottom:80px ;margin-left: 20px; margin-right: 20px;">
    <h2 style="color:#ffde65;">Visitor Comments</h2>


    <form method="GET" style="margin-bottom: 15px;">
        <label>Sort by:</label>
        <select name="commentsort" onchange="this.form.submit()">
            <option value="">Choose</option>
            <option value="name_asc" <?= (isset($_GET['commentsort']) && $_GET['commentsort'] == 'name_asc') ? 'selected' : '' ?>>Name A-Z</option>
            <option value="name_desc" <?= (isset($_GET['commentsort']) && $_GET['commentsort'] == 'name_desc') ? 'selected' : '' ?>>Name Z-A</option>
            <option value="date_asc" <?= (isset($_GET['commentsort']) && $_GET['commentsort'] == 'date_asc') ? 'selected' : '' ?>>Oldest First</option>
            <option value="date_desc" <?= (isset($_GET['commentsort']) && $_GET['commentsort'] == 'date_desc') ? 'selected' : '' ?>>Newest First</option>
        </select>
    </form>

    <h3 style="margin-top: 30px;">Leave a Comment</h3>
    <form method="POST" style="margin-bottom: 30px;">
        <input type="text" name="visitor_name" 
       value="<?= htmlspecialchars($username ?? '') ?>" 
       placeholder="Your name" required 
       <?= $user_id ? 'readonly' : '' ?>
       style="padding: 8px; width: 200px; border-radius: 5px; border: 1px solid #ccc; margin-bottom: 10px;">
<br>
        <textarea name="visitor_comment" placeholder="Your comment..." required 
            style="padding: 10px; width: 300px; height: 80px; border-radius: 5px; border: 1px solid #ccc;"></textarea><br>
        <button type="submit" style="padding: 10px 20px; background-color: #ffde65; border: none; border-radius: 5px; margin-top: 10px;">Post Comment</button>
    </form>

<?php foreach ($visitorComments as $name => $commentsList): ?>
    <?php foreach ($commentsList as $data): ?>
        <div style="background-color: white; padding: 15px; margin-bottom: 10px; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
            <strong><?= htmlspecialchars($name) ?></strong>
            <span style="float: right; color: gray; font-size: 0.9em;"><?= date("F j, Y", strtotime($data['created_at'])) ?></span>
            <p style="margin-top: 5px;"><?= htmlspecialchars($data['comment']) ?></p>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>

</div>



<?php include("footer.php"); ?>
</body>
</html>