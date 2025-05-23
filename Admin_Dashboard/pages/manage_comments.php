<?php
include_once(__DIR__ . "/../../database.php");

// Fshirja e një komenti
if (isset($_GET['delete_id'])) {
    $deleteId = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->bind_param("i", $deleteId);
    $stmt->execute();
    $stmt->close();
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
    <title>Comments Management</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;

        }
        th {
            background-color: #f5c518; 
            color: black;;
        }
        .delete-btn {
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="dashboard-section">
    <h2>Comments Management</h2>
<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center;">
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Comment</th>
        <th>Action</th>
    </tr>
    <?php foreach ($comments as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) ?></td>
            <td><?= htmlspecialchars($row['comment']) ?></td>
            <td>
              <button class="delete-btn" data-id="<?= $row['id'] ?>">Fshij</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
    </div>
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            if (!confirm("A jeni i sigurt që doni ta fshini këtë koment?")) return;

            const commentId = this.getAttribute("data-id");
            const row = this.closest("tr");

            fetch("pages/delete_comments.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `id=${commentId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    row.remove(); // fshin rreshtin nga tabela
                } else {
                    alert("Fshirja dështoi.");
                }
            })
            .catch(err => {
                console.error("Error:", err);
                alert("Ndodhi një gabim gjatë fshirjes.");
            });
        });
    });
});
</script>

</body>
</html>
