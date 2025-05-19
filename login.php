<?php
session_start();
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // Ketu vendosni kontrollin e vertete nga database
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     // Shembull i thjeshte statik (ndrysho me kontroll nga database)
//     if ($email == 'admin@amanpuri.com' && $password == 'admin123') {
//         $_SESSION['role'] = 'admin';
//         header('Location: dashboard_admin.php');
//         exit;
//     } elseif ($email == 'user@amanpuri.com' && $password == 'user123') {
//         $_SESSION['role'] = 'user';
//         header('Location: dashboard_user.php');
//         exit;
//     } else {
//         $error = "Invalid credentials!";
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Amanpuri Hotel</title>
  <style>
    body {
      background: url('foto/amanpuri-resort-phuket-thailand.jpg') no-repeat center center/cover;
      font-family: sans-serif;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: white;
    }

    .login-box {
      background: rgba(0, 0, 0, 0.75);
      padding: 30px;
      border-radius: 10px;
      width: 300px;
      text-align: center;
    }

    input[type="email"], input[type="password"] {
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
  <div class="login-box">
    <h2>Login to Amanpuri</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Email" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
      <a href="signup.php">Don't have an account? Sign Up</a>
    </form>
  </div>
</body>
</html>
