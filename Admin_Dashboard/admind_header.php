<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'])) {
    $theme = $_POST['theme'];
    setcookie('theme', $theme, time() + 60*60*24*30, '/'); // cookie për 30 ditë
  header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}

$theme = $_COOKIE['theme'] ?? 'light';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard - Amanpuri Hotel</title>
  <link rel="stylesheet" href="../css/sidebar.css" />
  
  <style>
    body.light-theme {
      background-color: white;
      color: black;
    }
    body.light-theme .dashboard-section {
      background-color: #f9f9f9;
      color: black;
    }
    body.dark-theme .dashboard-section h2,
    body.dark-theme .dashboard-section h3 {
      color: white;
    }
    body.light-theme table {
      background-color: white;
      color: black;
      border-color: #ddd;
    }
    body.light-theme table thead {
      background-color: #f5c518;
      color: black;
    }
    body.light-theme table tr:nth-child(even) {
      background-color: #fafafa;
    }
    
    /* Tema dark */
    body.dark-theme {
      background-color: #121212;
      color: #eee;
    }
    body.dark-theme .dashboard-section {
      background-color: #222;
      color: white;
    }
    body.dark-theme .stat-card,
    body.dark-theme .user-form {
      background-color: rgb(123, 120, 120);
      color: white;
    }
    body.dark-theme table {
      background-color: #1e1e1e;
      color: #eee;
      border-color: #555;
    }
    body.dark-theme table thead {
      background-color: #f5c518;
      color: black;
    }
    body.dark-theme table tr:nth-child(even) {
      background-color: #2a2a2a;
    }

    #theme-switcher {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #eee;
      padding: 10px;
      border-radius: 5px;
      z-index: 10000;
    }
    #theme-switcher button {
      cursor: pointer;
      padding: 5px 10px;
      margin-right: 10px;
      border: none;
      border-radius: 3px;
      font-weight: bold;
      background-color: #ccc;
      transition: background-color 0.3s;
    }
    #theme-switcher button:hover {
      background-color: #bbb;
    }
  </style>
</head>
<body class="<?= htmlspecialchars($theme) ?>-theme">

<div id="theme-switcher">
  <form method="POST" style="display:inline;">
    <button type="submit" name="theme" value="light">Light Theme</button>
  </form>
  <form method="POST" style="display:inline;">
    <button type="submit" name="theme" value="dark">Dark Theme</button>
  </form>
</div>
</body>
</html>
