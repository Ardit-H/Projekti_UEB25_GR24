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
<style>

    .dashboard-section h2, .dashboard-section h3 {
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    form.user-form {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px 30px;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .user-form label {
        display: flex;
        flex-direction: column;
        font-weight: 500;
        color: #444;
    }

    .user-form input,
    .user-form select {
        padding: 8px 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
        margin-top: 5px;
    }

 .user-form button {
    grid-column: span 2;
    width: 150px;
    padding: 8px;
    background-color: #f5c518;
    border: none;
    color: #000;
    font-weight: bold;
    font-size: 14px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    justify-self: center;
}

    .user-form button:hover {
        background-color: #e5b400;
    }

    table {
        margin-top: 30px;
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
    }

    thead {
        background-color: #f5c518;
        color: #000;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }


    button.delete {
        padding: 6px 10px;
        background-color: crimson;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button.delete:hover {
        background-color: darkred;
    }

</style>

<div class="dashboard-section">
    <h2>User Management</h2>
    <h3>Add New User</h3>

    <form class="user-form" method="post" action="">
        <label>Firstname
            <input type="text" name="firstname" required>
        </label>
        <label>Lastname
            <input type="text" name="lastname" required>
        </label>
        <label>Username
            <input type="text" name="username" required>
        </label>
        <label>Email
            <input type="email" name="email" required>
        </label>
        <label>Phone
            <input type="text" name="phone" required>
        </label>
        <label>Card Number
            <input type="text" name="card_number" required>
        </label>
        <label>Role
            <select name="roli" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </label>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <button type="submit">Add User</button>
    </form>

    <hr>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center;">
       <thead style="background-color: #f5c518; color: black;">
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
        <th>Veprimi</th>
    </tr>
</thead>
<tbody>
    <?php while ($user = mysqli_fetch_assoc($result)): ?>
        <tr id="user-row-<?= $user['id'] ?>">
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['firstname']) ?></td>
            <td><?= htmlspecialchars($user['lastname']) ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['phone']) ?></td>
            <td><?= htmlspecialchars($user['roli']) ?></td>
            <td><?= htmlspecialchars($user['card_number']) ?></td>
            <td><?= htmlspecialchars($user['created_time']) ?></td>
            <td>
                <button onclick="deleteUser(<?= $user['id'] ?>)">Fshij</button>
            </td>
        </tr>
    <?php endwhile; ?>
</tbody>
    </table>
</div>
<script>
function deleteUser(userId) {
    if (!confirm("A jeni i sigurt që doni ta fshini këtë përdorues?")) return;
    fetch("pages/delete_users.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + encodeURIComponent(userId)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("user-row-" + userId).remove();
        } else {
            alert("Fshirja dështoi: " + (data.message || "Gabim i panjohur"));
        }
    })
    .catch(error => {
        console.error("Gabim gjatë AJAX:", error);
        alert("Ndodhi një gabim gjatë fshirjes.");
    });
}
</script>