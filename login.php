<?php
session_start();
require_once("database.php");
$error="";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $username=$_POST['username'];
  $password=$_POST['password'];
  
   $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1){
        $user = $result->fetch_assoc();

        echo "Salt: {$user['salt']}<br>";
        echo "Salted Hash: {$user['hashed_password']}<br>";

        $hashed_input_password = hash('sha256', $user['salt'] . $password);
        echo "Pas login: <br>" . $hashed_input_password;
        if ($hashed_input_password === $user['hashed_password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['roli'] = $user['roli'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['card_number']=$user['card_number'];

            if ($user['roli'] === 'admin') {
                // header('Location: admin_dashboard.php');
            } else {
                // header('Location: user_dashboard.php');
            }
             header('Location: index.php');
            exit;
        } else {
            $error = "Password is incorrect.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
    $conn->close();

}

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

    input[type="text"], input[type="password"] {
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
      <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
      <a href="signup.php">Don't have an account? Sign Up</a>
    </form>
  </div>
</body>
</html>
