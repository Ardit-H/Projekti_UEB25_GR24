<?php
include_once("database.php");

// Fshirja e një komenti
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM comments WHERE id = :id");
    $stmt->execute(['id' => $deleteId]);
    header("Location: manage_comments.php");
    exit;
}

// Marrja e komenteve me të dhënat e përdoruesit
$sql = "
    SELECT comments.id, comments.comment, users.firstname, users.lastname
    FROM comments
    LEFT JOIN users ON comments.user_id = users.id
    ORDER BY comments.id DESC
";
$result = mysqli_query($conn, $sql);
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Menaxhimi i Komenteve</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .delete-btn {
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Komentet e Përdoruesve</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Përdoruesi</th>
        <th>Komenti</th>
        <th>Veprimi</th>
    </tr>
    <?php foreach ($comments as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) ?></td>
            <td><?= htmlspecialchars($row['comment']) ?></td>
            <td>
                <a class="delete-btn" href="manage_comments.php?delete_id=<?= $row['id'] ?>" onclick="return confirm('A jeni i sigurt që doni ta fshini këtë koment?');">Fshij</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
