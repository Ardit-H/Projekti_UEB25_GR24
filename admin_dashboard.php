<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Amanpuri Hotel</title>
  <link rel="stylesheet" href="css/headerstyles.css">
  <link rel="stylesheet" href="css/footerstyles.css">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
    }

    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #2c2c2c;
      padding-top: 20px;
      box-shadow: 2px 0 5px rgba(0,0,0,0.2);
    }

    .sidebar h2 {
      color: #f5c518;
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 15px;
      text-decoration: none;
      transition: background 0.3s;
    }

    .sidebar a:hover {
      background-color: #444;
    }

    .main-content {
      margin-left: 250px;
      padding: 30px;
    }

    .main-content h1 {
      color: #f5c518;
    }

    .dashboard-section {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      padding: 25px;
      margin-bottom: 30px;
    }

    .dashboard-section h3 {
      color: #333;
      border-bottom: 1px solid #eee;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .btn {
      background-color: #f5c518;
      border: none;
      color: #fff;
      padding: 10px 20px;
      margin-right: 10px;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #e0b914;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h2>Admin Panel</h2>
  <a href="#">Home Content</a>
  <a href="#">Rooms Management</a>
  <a href="#">Restaurant</a>
  <a href="#">About Page</a>
  <a href="#">Contact Messages</a>
  <a href="#">Reservations</a>
  <a href="#">Logout</a>
</div>

<div class="main-content">
  <h1>Welcome, Administrator</h1>

  <div class="dashboard-section">
    <h3>Quick Actions</h3>
    <button class="btn">Add Room</button>
    <button class="btn">Edit Home</button>
    <button class="btn">View Reservations</button>
  </div>

  <div class="dashboard-section">
    <h3>Recent Reservations</h3>
    <table style="width: 100%; border-collapse: collapse;">
      <thead style="background-color: #f5c518; color: white;">
        <tr>
          <th style="padding: 10px;">Name</th>
          <th style="padding: 10px;">Check-in</th>
          <th style="padding: 10px;">Check-out</th>
          <th style="padding: 10px;">Room</th>
          <th style="padding: 10px;">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr style="text-align: center; background-color: #f9f9f9;">
          <td>John Doe</td>
          <td>2025-06-01</td>
          <td>2025-06-05</td>
          <td>Deluxe Villa</td>
          <td>Confirmed</td>
        </tr>
      </tbody>
    </table>
  </div>

</div>

</body>
</html>
