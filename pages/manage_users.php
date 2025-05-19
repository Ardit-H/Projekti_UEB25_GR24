<?php 
include_once("database.php");

function clean($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}
function generateSalt($length = 16) {
    return bin2hex(random_bytes($length));
}
function hashPassword($password, $salt) {
    return hash('sha256', $salt . $password);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstname = clean($_POST['firstname']);
    $lastname = clean($_POST['lastname']);
    $username = clean($_POST['username']);
    $email = clean($_POST['email']);
    $phone = clean($_POST['phone']);
    $roli = clean($_POST['roli']);
    $card_number = clean($_POST['card_number']);
    $password = $_POST['password']; 
    
    if (empty($password)) {
        echo "<p style='color:red;'>Password is required for new users.</p>";
    } else {
        $created_time = date('Y-m-d H:i:s');
        $salt = generateSalt();
        $password_hash = hashPassword($password, $salt);

$sql_insert = "INSERT INTO users (firstname, lastname, username, email, phone, card_number, salt, hashed_password, roli) VALUES (
    '$firstname', '$lastname', '$username', '$email', '$phone', '$card_number', '$salt', '$password_hash', '$roli')";

        if (mysqli_query($conn, $sql_insert)) {
            echo "<p style='color:green;'>User added successfully.</p>";
        } else {
            echo "<p style='color:red;'>Error adding user: " . mysqli_error($conn) . "</p>";
        }
    }
}

$sql = "SELECT id, firstname, lastname, username, email, phone, roli, card_number, created_time FROM users ORDER BY id ASC";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "<p style='color:red;'>Error retrieving users: " . mysqli_error($conn) . "</p>";
    exit;
}
?>

<div class="dashboard-section">
    <h2>User Management</h2>

    <h3>Add New User</h3>
    <form method="post" action="">
        <label>Firstname: <input type="text" name="firstname" required></label><br>
        <label>Lastname: <input type="text" name="lastname" required></label><br>
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Phone: <input type="text" name="phone" required></label><br>
        <label>Role: 
            <select name="roli" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </label><br>
        <label>Card Number: <input type="text" name="card_number" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br><br>
        <button type="submit">Add User</button>
    </form>

    <hr>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center;">
        <thead style="background-color: #4CAF50; color: white;">
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Card Number</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['firstname']) ?></td>
                    <td><?= htmlspecialchars($user['lastname']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['phone']) ?></td>
                    <td><?= htmlspecialchars($user['roli']) ?></td>
                    <td><?= htmlspecialchars($user['card_number']) ?></td>
                    <td><?= htmlspecialchars($user['created_time']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
