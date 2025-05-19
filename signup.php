<!-- <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ruajtje e të dhënave në database (jo e përfshirë këtu)
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'user'; // default

    // Nje redirect i thjeshte
    header('Location: login.php');
    exit;
}
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up - Amanpuri Hotel</title>
  <style>
    body {
      background: url('foto/Amanpuri-21.jpg') no-repeat center center/cover;
      font-family: sans-serif;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: white;
    }

    .signup-box {
      background: rgba(0, 0, 0, 0.75);
      padding: 30px;
      border-radius: 10px;
      width: 300px;
      text-align: center;
    }

    input[type="text"], input[type="email"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 5px;
    }

    button {
      background-color: #f5c518;
      border: none;
      padding: 10px;
      width: 100%;
      color: black;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
    }

    a {
      color: #f5c518;
      text-decoration: none;
      display: block;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="signup-box">
    <h2>Sign Up</h2>
    <form method="POST">
      <input type="text" name="name" placeholder="Full Name" required><br>
      <input type="email" name="email" placeholder="Email" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Sign Up</button>
      <a href="login.php">Already have an account? Login</a>
    </form>
  </div>
</body>
</html>
