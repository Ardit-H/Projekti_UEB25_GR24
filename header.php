<?php session_start(); ?>
<header>
  <style>

    .auth-buttons {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .auth-buttons a {
   background: #f5c518;
  color: #121212;
  padding: 0.5rem 1rem;
  border-radius: 25px;
  margin-left: 1rem;
  font-weight: bold;
  transition: background 0.3s, transform 0.2s;
   text-decoration: none;
    }
.auth-buttons a:hover {
  background: #ffdb4d;
  transform: scale(1.05);
}
    .user-icon {
      font-size: 20px;
      margin-right: 5px;
    }
      .header-content {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    .nav-auth-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      max-width: 1000px;
      margin-top: 10px;
    }
  </style>
    <div class="header-content">
      <h1>Amanpuri Hotel</h1>
      <div class="nav-auth-container">
      <nav>
        <a href="index.php" >Home</a>
        <a href="rooms.php">Rooms</a>
        <a href="restaurant.php">Restaurant</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="book.php" class="book">Book Now</a>
      </nav>
      <div class="auth-buttons">
      <?php if (isset($_SESSION['username'])): ?>
        <span class="user-icon">🔓</span>
        <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign Up</a>
      <?php endif; ?>
    </div>
    </div>
      </div>
  </header>
 
  