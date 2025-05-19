<?php
session_start();
include("admind_header.php");
include("sidebar.php");
?>

<div class="main-content">
    <h1>Welcome, Administrator</h1>

    <?php
    $page = $_GET['page'] ?? 'home';

    switch ($page) {
        case 'home':
            include("pages/home.php");
            break;
        case 'rooms':
            include("pages/rooms.php");
            break;
        case 'restaurant':
            include("pages/restaurant.php");
            break;
        case 'comments':
            include("pages/comments.php");
            break;
        case 'users':
            include("pages/users.php");
            break;
        default:
            echo "<p>Page not found.</p>";
            break;
    }
    ?>
</div>

