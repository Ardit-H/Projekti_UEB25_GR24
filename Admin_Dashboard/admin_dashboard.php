<?php
session_start();
include("admind_header.php");
include("sidebar.php");
?>

<div class="main-content">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['firstname']) ?></h1>

    <?php
    $page = $_GET['page'] ?? 'home';

    switch ($page) {
        case 'home':
            include("pages/home.php");
            break;
        case 'rooms':
            include("pages/manage_rooms.php");
            break;
        case 'restaurant':
            include("pages/manage_tables.php");
            break;
        case 'comments':
            include("pages/manage_comments.php");
            break;
        case 'flights':
            include("pages/manage_flights.php");
            break;   
        case 'users':
            include("pages/manage_users.php");
            break;
        default:
            echo "<p>Page not found.</p>";
            break;
    }
    ?>
</div>

